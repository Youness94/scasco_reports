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
        return Appointment::with('creator', 'updater', 'potential_case.client')->get();
    }

    public function getClientByCase($potencial_case_id)
    {
        $potential_case = PotencialCase::with('client')->find($potencial_case_id);

        if ($potential_case) {
            return [
                'client_id' => $potential_case->client->id,
                'client_first_name' => $potential_case->client->client_first_name,
                'client_last_name' => $potential_case->client->client_last_name,
            ];
        }

        return null;
    }

    public function addAppointmentData()
    {
        $appointments = Appointment::with('creator', 'updater')->get();
        $potential_cases = PotencialCase::with('client')->get();

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
                'Appointment added to the case',
                $potentialCase,
                $appointment->id,
                null,
                Auth::id()
            );

            DB::commit();
            return ['status' => 'success', 'message' => 'Appointment created successfully'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Appointment creation failed: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Appointment not created'];
        }
    }

    public function getEditAppointmentData($id)
    {
        $appointment = Appointment::with('creator', 'updater', 'potential_case.client')->findOrFail($id);
        $potential_cases = PotencialCase::with('client')->get();

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
                'Appointment updated',
                $potentialCase,
                $appointment->id,
                null,
                $user->id
            );

            DB::commit();
            return ['status' => 'success', 'message' => 'Appointment updated successfully'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Appointment update failed: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointment::with('creator', 'updater')->findOrFail($id);
        $appointment->delete();

        return ['status' => 'success', 'message' => 'Appointment deleted successfully'];
    }
}
