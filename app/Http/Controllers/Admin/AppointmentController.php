<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PotencialCase;
use App\Services\PotencialCaseHisotryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    protected $potencialCaseHisotryService;
    public function __construct(PotencialCaseHisotryService $potencialCaseHisotryService)
    {
        $this->potencialCaseHisotryService = $potencialCaseHisotryService;
    }
    public function get_all_appointments()
    {

        $appointments = Appointment::with('creator', 'updater', 'potential_case.client')->get();

        return view('appointments.appointments_list', compact('appointments'));
    }

    public function getClientByCase($potencial_case_id)
    {
        $potential_case = PotencialCase::with('client')->find($potencial_case_id);

        if ($potential_case) {
            return response()->json([
                'client_id' => $potential_case->client->id,
                'client_first_name' => $potential_case->client->client_first_name,
                'client_last_name' => $potential_case->client->client_last_name,
            ]);
        }

        return response()->json(['error' => 'Client not found'], 404);
    }

    public function add_appointment()
    {

        $appointments = Appointment::with('creator', 'updater')->get();
        $potential_cases = PotencialCase::with('client')->get();
        return view('appointments.add_appointment', compact('appointments', 'potential_cases'));
    }


    public function store_appointment(Request $request)
    {
        $validatedData = $request->validate([
            'date_appointment' => 'required',
            'place' => 'required',
            'status' => 'nullable',
            'potencial_case_id' => 'required|exists:potencial_cases,id',

        ], [

        ]);
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $potentialCase = PotencialCase::with('client')->findOrFail($validatedData['potencial_case_id']);
            $clientId = $potentialCase->client->id;
            // $dateAppointment = Carbon::parse($validatedData['date_appointment'])->format('Y-m-d');
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
            return redirect('/rendez-vous')->with('success', 'Appointment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return redirect('/ajouter-rendez-voust')->with('Error', 'Appointment not created');
        }
    }

    public function edit_appointment($id)
    {

        $appointment = Appointment::with('creator', 'updater', 'potential_case.client')->findOrFail($id);
        $potential_cases = PotencialCase::with('client')->get();
        return view('appointments.edit_appointment', compact('appointment', 'potential_cases'));
    }

    public function update_appointment(Request $request, $id)
    {
        $appointment = Appointment::with('creator', 'updater', 'potential_case.client')->findOrFail($id);
        $validatedData = $request->validate([
           'date_appointment' => 'sometimes',
            'place' => 'sometimes',
            'status' => 'sometimes',
            'potencial_case_id' => 'sometimes|exists:potencial_cases,id',

        ], [
           
        ]);
      
        
        DB::beginTransaction();
        try {

            $user = Auth::user();
            $potentialCase = PotencialCase::with('client')->findOrFail($validatedData['potencial_case_id']);
            $clientId = $potentialCase->client->id;

            $appointment->date_appointment = $request->input('date_appointment');
            $appointment->place = $request->input('place');
            $appointment->potencial_case_id = $request->input('potencial_case_id');
            $appointment->client_id = $clientId;
            $appointment->status = $request->input('status') ??  $appointment->status  ;
            $appointment->updated_by = $user->id;
            $appointment->save();

            DB::commit();
            return redirect('/rendez-vous')->with('success', 'Appointment updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Appointment creation failed: ' . $e->getMessage());
            return [
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ];
        }
    }

    public function delete_appointment($id)
    {
        $appointment = Appointment::with('creator', 'updater')->findOrFail($id);
        $appointment->delete();
        return redirect('/rendez-vous')->with('success', 'Appointment deleted successfully');
    }
}
