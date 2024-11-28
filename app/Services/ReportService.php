<?php

namespace App\Services;

use App\Models\Report;
use App\Models\PotencialCase;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ReportService
{
    protected $potencialCaseHisotryService;

    public function __construct(PotencialCaseHisotryService $potencialCaseHisotryService)
    {
        $this->potencialCaseHisotryService = $potencialCaseHisotryService;
    }

    public function getAllReports()
    {
        return Report::with('creator', 'updater', 'potential_case', 'appointment')->get();
    }

    public function getAppointmentsByCase($potencial_case_id)
    {
        return Appointment::where('potencial_case_id', $potencial_case_id)->get();
    }

    public function getPotentialCasesAndAppointments()
    {
        $potential_cases = PotencialCase::all();
        $appointments = Appointment::all();
        return compact('potential_cases', 'appointments');
    }

    public function createReport(array $data)
    {
        DB::beginTransaction();
        try {
            $potentialCase = PotencialCase::with('client')->findOrFail($data['potencial_case_id']);
            $user = Auth::user();
            $report = Report::create([
                'date_report' => now(),
                'contenu' => $data['contenu'],
                'potencial_case_id' => $data['potencial_case_id'],
                'appointment_id' => $data['appointment_id'],
                'created_by' => $user->id,
            ]);
            $this->potencialCaseHisotryService->createHistoryRecord(
                'report_added', 
                'Report added to the case', 
                $potentialCase, 
                null, 
                $report->id, 
                $user->id
            );
            DB::commit();
            return $report;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Report creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getReport($id)
    {
        return Report::with('creator', 'updater', 'potential_case', 'appointment')->findOrFail($id);
    }

    public function updateReport($id, array $data)
    {
        $report = Report::with('creator', 'updater', 'potential_case', 'appointment')->findOrFail($id);
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $report->contenu = $data['contenu'];
            $report->potencial_case_id = $data['potencial_case_id'];
            $report->appointment_id = $data['appointment_id'];
            $report->updated_by = $user->id;
            $report->save();
            $this->potencialCaseHisotryService->createHistoryRecord(
                'updated', 
                'Report updated', 
                $report->potential_case, 
                null, 
                $report->id, 
                $user->id
            );
            DB::commit();
            return $report;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Report update failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteReport($id)
    {
        $report = Report::with('creator', 'updater', 'potential_case')->findOrFail($id);
        $report->delete();
        return $report;
    }
}
