<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Services\PotencialCaseHisotryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService, PotencialCaseHisotryService $potencialCaseHisotryService)
    {
        $this->reportService = $reportService;
    }

    public function get_all_reports()
    {
        $reports = $this->reportService->getAllReports();
        return view('reports.reports_list', compact('reports'));
    }

    public function get_appointments_by_case($potencial_case_id)
    {
        $appointments = $this->reportService->getAppointmentsByCase($potencial_case_id);
        return response()->json($appointments);
    }

    public function add_report()
    {
        $data = $this->reportService->getPotentialCasesAndAppointments();
        Log::info('potential_cases ' . $data['potential_cases']);
        return view('reports.add_report', $data);
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
            return redirect('/comptes-rendus')->with('success', 'Report created successfully');
        } catch (\Exception $e) {
            return redirect('/ajouter-compte-rendu')->with('error', 'Report not created');
        }
    }

    public function edit_report($id)
    {
        $report = $this->reportService->getReport($id);
        $data = $this->reportService->getPotentialCasesAndAppointments();
        $data['report'] = $report;
        return view('reports.edit_report', $data);
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
            'potencial_case_id.exists' => 'Le cas potentiel sélectionné n\'existe pas.',
            'appointment_id.exists' => 'L\'appointment sélectionné n\'existe pas.',
        ]);

        try {
            $this->reportService->updateReport($id, $validatedData);
            return redirect('/comptes-rendus')->with('success', 'Report updated successfully');
        } catch (\Exception $e) {
            return redirect('/modifier-compte-rendu/' . $id)->with('error', 'Report not updated');
        }
    }

    public function delete_report($id)
    {
        try {
            $this->reportService->deleteReport($id);
            return redirect('/comptes-rendus')->with('success', 'Report deleted successfully');
        } catch (\Exception $e) {
            return redirect('/comptes-rendus')->with('error', 'Report not deleted');
        }
    }
}