<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Http\Requests\UpdateReportRequest;
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

    public function store_report(ReportRequest $request)
    {
        $validatedData = $request->validated();
       

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

    public function update_report(UpdateReportRequest $request, $id)
    {
        $validatedData = $request->validated();

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