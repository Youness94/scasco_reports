<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PotencialCase;
use App\Services\PotencialCaseHisotryService;
use Carbon\Carbon;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function get_all_appointments()
    {
        $appointments = $this->appointmentService->getAllAppointments();
        return view('appointments.appointments_list', compact('appointments'));
    }

    public function getClientByCase($potencial_case_id)
    {
        $clientData = $this->appointmentService->getClientByCase($potencial_case_id);

        if ($clientData) {
            return response()->json($clientData);
        }

        return response()->json(['error' => 'Client not found'], 404);
    }

    public function add_appointment()
    {
        $data = $this->appointmentService->addAppointmentData();
        return view('appointments.add_appointment', $data);
    }

    public function store_appointment(Request $request)
    {
        $validatedData = $request->validate([
            'date_appointment' => 'required',
            'place' => 'required',
            'status' => 'nullable',
            'potencial_case_id' => 'required|exists:potencial_cases,id',
        ], [
            'date_appointment.required' => 'La date du rendez-vous est obligatoire.',
            'place.required' => 'Le lieu du rendez-vous est obligatoire.',
            'status.nullable' => 'Le statut est optionnel.',
            'potencial_case_id.required' => 'L\'ID du cas potentiel est obligatoire.',
            'potencial_case_id.exists' => 'Le cas potentiel avec cet ID n\'existe pas.',
        ]);

        $result = $this->appointmentService->storeAppointment($validatedData);

        if ($result['status'] == 'success') {
            return redirect('/rendez-vous')->with('success', $result['message']);
        }

        return redirect('/ajouter-rendez-voust')->with('error', $result['message']);
    }

    public function edit_appointment($id)
    {
        $data = $this->appointmentService->getEditAppointmentData($id);
        return view('appointments.edit_appointment', $data);
    }

    public function update_appointment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'date_appointment' => 'sometimes',
            'place' => 'sometimes',
            'status' => 'sometimes',
            'potencial_case_id' => 'sometimes|exists:potencial_cases,id',
        ], [
            'date_appointment.sometimes' => 'La date du rendez-vous est obligatoire.',
            'place.sometimes' => 'Le lieu du rendez-vous est obligatoire.',
            'status.nullable' => 'Le statut est optionnel.',
            'potencial_case_id.sometimes' => 'L\'ID du cas potentiel est obligatoire.',
            'potencial_case_id.exists' => 'Le cas potentiel avec cet ID n\'existe pas.',
        ]);

        $result = $this->appointmentService->updateAppointment($validatedData, $id);

        if ($result['status'] == 'success') {
            return redirect('/rendez-vous')->with('success', $result['message']);
        }

        return response()->json(['status' => 'Error', 'message' => $result['message']]);
    }

    public function delete_appointment($id)
    {
        $result = $this->appointmentService->deleteAppointment($id);

        if ($result['status'] == 'success') {
            return redirect('/rendez-vous')->with('success', $result['message']);
        }

        return response()->json(['status' => 'Error', 'message' => $result['message']]);
    }
}
