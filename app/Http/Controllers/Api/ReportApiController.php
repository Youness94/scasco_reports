<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportApiController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function get_all_reports()
    {
        $reports = $this->reportService->getAllReports();
        return response()->json($reports);
    }

    public function get_appointments_by_case($potencial_case_id)
    {
        $appointments = $this->reportService->getAppointmentsByCase($potencial_case_id);
        return response()->json($appointments);
    }

    public function store_report(Request $request)
    {
        $validatedData = $request->validate([
            'contenu' => 'required',
            'potencial_case_id' => 'required|exists:potencial_cases,id',
            'appointment_id' => 'nullable|exists:appointments,id',
        ], [
            'contenu.required' => 'Le contenu est requis.',
            'potencial_case_id.required' => 'Le cas potentiel est requis.',
            'potencial_case_id.exists' => 'Le cas potentiel sélectionné n\'existe pas.',
            'appointment_id.exists' => 'L\'appointment sélectionné n\'existe pas.',
        ]);

        try {
            $this->reportService->createReport($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Report created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Report not created: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function edit_report($id)
    {
        $report = $this->reportService->getReport($id);
        if ($report) {
            $data = $this->reportService->getPotentialCasesAndAppointments();
            $data['report'] = $report;
            return response()->json($data);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Report not found',
        ], 404);
    }

    public function update_report(Request $request, $id)
    {
        $validatedData = $request->validate([
            'contenu' => 'sometimes',
            'potencial_case_id' => 'sometimes|exists:potencial_cases,id',
            'appointment_id' => 'sometimes|exists:appointments,id',
        ], [
            'contenu.sometimes' => 'Le contenu est requis.',
            'potencial_case_id.sometimes' => 'Le cas potentiel est requis.',
            'appointment_id.sometimes' => 'L\'appointment est requis.',
        ]);

        try {
            $this->reportService->updateReport($id, $validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Report updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Report not updated: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function delete_report($id)
    {
        try {
            $this->reportService->deleteReport($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Report deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Report not deleted: ' . $e->getMessage(),
            ], 400);
        }
    }
}