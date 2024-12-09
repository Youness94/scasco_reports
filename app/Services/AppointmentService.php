<?php



namespace App\Services;

use App\Models\Appointment;
use App\Models\PotencialCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentService
{
    protected $potencialCaseHisotryService;

    public function __construct(PotencialCaseHisotryService $potencialCaseHisotryService)
    {
        $this->potencialCaseHisotryService = $potencialCaseHisotryService;
    }

    public function getAllAppointments()
    {
        $user = auth()->user();

        if ($user->user_type == 'Super Responsable') {
            return Appointment::with('creator', 'updater', 'potential_case.client')->get();
        }

        if ($user->user_type == 'Responsable') {
            return Appointment::with('creator', 'updater', 'potential_case.client')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->get();
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            return Appointment::with('creator', 'updater', 'potential_case.client')
                ->where('created_by', $user->id)
                ->get();
        }

        return [];
    }
    // public function getClientByCase($potencial_case_id)
    // {
    //     $potential_case = PotencialCase::with('client')->find($potencial_case_id);

    //     if ($potential_case) {
    //         return [
    //             'client_id' => $potential_case->client->id,
    //             'client_first_name' => $potential_case->client->client_first_name,
    //             'client_last_name' => $potential_case->client->client_last_name,
    //         ];
    //     }

    //     return null;
    // }
    public function getClientByCase($potencial_case_id)
    {
        $user = auth()->user();

        if ($user->user_type == 'Super Responsable') {
            $potential_case = PotencialCase::with('client')->find($potencial_case_id);
            if ($potential_case) {
                return [
                    'client_id' => $potential_case->client->id,
                    'client_first_name' => $potential_case->client->client_first_name,
                    'client_last_name' => $potential_case->client->client_last_name,
                ];
            }
        }

        if ($user->user_type == 'Responsable') {
            $potential_case = PotencialCase::with('client')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->find($potencial_case_id);

            if ($potential_case) {
                return [
                    'client_id' => $potential_case->client->id,
                    'client_first_name' => $potential_case->client->client_first_name,
                    'client_last_name' => $potential_case->client->client_last_name,
                ];
            }
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $potential_case = PotencialCase::with('client')
                ->where('created_by', $user->id)
                ->find($potencial_case_id);

            if ($potential_case) {
                return [
                    'client_id' => $potential_case->client->id,
                    'client_first_name' => $potential_case->client->client_first_name,
                    'client_last_name' => $potential_case->client->client_last_name,
                ];
            }
        }

        return null;
    }

    public function addAppointmentData()
    {
        $user = auth()->user();
        $appointments = [];
        $potential_cases = [];

        if ($user->user_type == 'Super Responsable') {
            $appointments = Appointment::with('creator', 'updater')->get();
            $potential_cases = PotencialCase::with('client')->get();
        }

        if ($user->user_type == 'Responsable') {
            $appointments = Appointment::with('creator', 'updater')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->get();

            $potential_cases = PotencialCase::with('client')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->get();
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $appointments = Appointment::with('creator', 'updater')
                ->where('created_by', $user->id)
                ->get();

            $potential_cases = PotencialCase::with('client')
                ->where('created_by', $user->id)
                ->get();
        }

        return compact('appointments', 'potential_cases');
    }

    public function storeAppointment($validatedData)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $potentialCase = PotencialCase::with('client')->findOrFail($validatedData['potencial_case_id']);
            $clientId = $potentialCase->client->id;

            $appointment = Appointment::create([
                'date_appointment' => $validatedData['date_appointment'],
                'place' => $validatedData['place'],
                'status' => 'pending',
                'potencial_case_id' => $validatedData['potencial_case_id'],
                'client_id' => $clientId,
                'created_by' => $user->id,
            ]);

            $this->potencialCaseHisotryService->createHistoryRecord(
                'appointment_added',
                'Rendez-vous ajouté à l\'affaire',
                $potentialCase,
                $appointment->id,
                null,
                Auth::id()
            );

            DB::commit();
            return ['status' => 'success', 'message' => 'Rendez-vous ajouté à l\'affaire avec succès'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Appointment creation failed: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Appointment not created'];
        }
    }

    public function getEditAppointmentData($id)
    {
        $user = auth()->user();
        $appointment = null;
        $potential_cases = [];

        if ($user->user_type == 'Super Responsable') {
            $appointment = Appointment::with('creator', 'updater', 'potential_case.client')->findOrFail($id);
            $potential_cases = PotencialCase::with('client')->get();
        }

        if ($user->user_type == 'Responsable') {
            $appointment = Appointment::with('creator', 'updater', 'potential_case.client')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->findOrFail($id);

            $potential_cases = PotencialCase::with('client')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->get();
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $appointment = Appointment::with('creator', 'updater', 'potential_case.client')
                ->where('created_by', $user->id)
                ->findOrFail($id);

            $potential_cases = PotencialCase::with('client')
                ->where('created_by', $user->id)
                ->get();
        }

        return compact('appointment', 'potential_cases');
    }

    public function updateAppointment($validatedData, $id)
    {
        DB::beginTransaction();
        try {
            $appointment = Appointment::with('creator', 'updater', 'potential_case.client')->findOrFail($id);
            $user = Auth::user();
            $potentialCase = PotencialCase::with('client')->findOrFail($validatedData['potencial_case_id']);
            $clientId = $potentialCase->client->id;

            $appointment->date_appointment = $validatedData['date_appointment'] ?? $appointment->date_appointment;
            $appointment->place = $validatedData['place'] ?? $appointment->place;
            $appointment->potencial_case_id = $validatedData['potencial_case_id'] ?? $appointment->potencial_case_id;
            $appointment->client_id = $clientId;
            $appointment->status = $validatedData['status'] ?? $appointment->status;
            $appointment->updated_by = $user->id;
            $appointment->save();

            $this->potencialCaseHisotryService->createHistoryRecord(
                'updated',
                'Rendez-vous a été mise à jour',
                $potentialCase,
                $appointment->id,
                null,
                $user->id
            );

            DB::commit();
            return ['status' => 'success', 'message' => 'Rendez-vous a été mis à jour avec succès'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Appointment update failed: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }

    public function deleteAppointment($id)
    {
        $user = auth()->user();
        $appointment = null;

        if ($user->user_type == 'Super Responsable') {
            $appointment = Appointment::with('creator', 'updater')->findOrFail($id);
        }

        if ($user->user_type == 'Responsable') {
            $appointment = Appointment::with('creator', 'updater')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->findOrFail($id);
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $appointment = Appointment::with('creator', 'updater')
                ->where('created_by', $user->id)
                ->findOrFail($id);
        }

        if (!$appointment) {
            return ['status' => 'error', 'message' => 'You are not authorized to delete this appointment'];
        }

        try {
            $appointment->delete();
            return ['status' => 'success', 'message' => 'Appointment deleted successfully'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Error deleting appointment: ' . $e->getMessage()];
        }
    }

    public function detailsAppointment()
    {
        $user = auth()->user();
        $appointments = [];
        $potential_cases = [];

        if ($user->user_type == 'Super Responsable') {
            $appointments = Appointment::with('creator', 'updater', 'potential_case.client')
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->potential_case->case_number,
                    'client' => $appointment->client->client_first_name . ' ' . $appointment->client->client_last_name,
                    'start' => $appointment->date_appointment->toIso8601String(), 
                    'place' => $appointment->place,
                    'status' => $appointment->statuts,
                ];
            });
            $potential_cases = PotencialCase::with('client')->get();
        }

        if ($user->user_type == 'Responsable') {
            $appointments = Appointment::with('creator', 'updater', 'potential_case.client')
            ->whereIn('created_by', function ($query) use ($user) {
                $query->select('id')
                    ->from('users')
                    ->where('responsible_id', $user->id)
                    ->whereIn('user_type', ['Admin', 'Commercial']);
            })
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->potential_case->case_number,
                    'client' => $appointment->client->client_first_name . ' ' . $appointment->client->client_last_name,
                    'start' => $appointment->date_appointment->toIso8601String(), 
                    'place' => $appointment->place,
                    'status' => $appointment->statuts,
                ];
            });
            $potential_cases = PotencialCase::with('client')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->get();
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $appointments = Appointment::with('creator', 'updater', 'potential_case.client')
            ->where('created_by', $user->id)
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->potential_case->case_number,
                    'client' => $appointment->client->client_first_name . ' ' . $appointment->client->client_last_name,
                    'start' => $appointment->date_appointment->toIso8601String(), 
                    'place' => $appointment->place,
                    'status' => $appointment->statuts,
                ];
            });
            $potential_cases = PotencialCase::with('client')
                ->where('created_by', $user->id)
                ->get();
        }
        // $appointments = Appointment::with('creator', 'updater', 'potential_case.client')
        //     ->get()
        //     ->map(function ($appointment) {
        //         return [
        //             'id' => $appointment->id,
        //             'title' => $appointment->potential_case->case_number,
        //             'client' => $appointment->client->client_first_name . ' ' . $appointment->client->client_last_name,
        //             'start' => $appointment->date_appointment->toIso8601String(), 
        //             'place' => $appointment->place,
        //             'status' => $appointment->statuts,
        //         ];
        //     });

        return [
            'appointments' => $appointments,
            'potential_cases' => $potential_cases,
        ];
    }
}
