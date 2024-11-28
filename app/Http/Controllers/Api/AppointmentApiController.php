<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentApiController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function get_all_appointments()
    {
        $appointments = $this->appointmentService->getAllAppointments();
        return response()->json($appointments);
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
        return response()->json($data);
    }

    public function store_appointment(AppointmentRequest $request)
    {
        $validatedData = $request->validated();
        $result = $this->appointmentService->storeAppointment($validatedData);

        if ($result['status'] == 'success') {
            return response()->json(['message' => $result['message']], 201);
        }

        return response()->json(['error' => $result['message']], 400);
    }

    public function edit_appointment($id)
    {
        $data = $this->appointmentService->getEditAppointmentData($id);

        if ($data) {
            return response()->json($data);
        }

        return response()->json(['error' => 'Appointment not found'], 404);
    }

    public function update_appointment(UpdateAppointmentRequest $request, $id)
    {
        $validatedData = $request->validated();
        $result = $this->appointmentService->updateAppointment($validatedData, $id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => $result['message']]);
        }

        return response()->json(['error' => $result['message']], 400);
    }

    public function delete_appointment($id)
    {
        $result = $this->appointmentService->deleteAppointment($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => $result['message']]);
        }

        return response()->json(['error' => $result['message']], 400);
    }
}
