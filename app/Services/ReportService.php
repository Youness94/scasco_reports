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
        $user = auth()->user();
    
        if ($user->user_type == 'Super Responsable') {
            return Report::with('creator', 'updater', 'potential_case', 'appointment')->get();
        }
    
        if ($user->user_type == 'Responsable') {
            return Report::with('creator', 'updater', 'potential_case', 'appointment')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->get();
        }
    
        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            return Report::with('creator', 'updater', 'potential_case', 'appointment')
                ->where('created_by', $user->id)
                ->get();
        }
    
        return [];
    }
    
    public function getAppointmentsByCase($potencial_case_id)
    {
        $user = auth()->user();
    
        if ($user->user_type == 'Super Responsable') {
            return Appointment::where('potencial_case_id', $potencial_case_id)->get();
        }
    
        if ($user->user_type == 'Responsable') {
            return Appointment::where('potencial_case_id', $potencial_case_id)
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->get();
        }
    
        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            return Appointment::where('potencial_case_id', $potencial_case_id)
                ->where('created_by', $user->id)
                ->get();
        }
   
        return [];
    }
    
    public function getPotentialCasesAndAppointments()
    {
        $user = auth()->user();
        $potential_cases = [];
    
        if ($user->user_type == 'Super Responsable') {
            $potential_cases = PotencialCase::all();
        }
    
        if ($user->user_type == 'Responsable') {
            $potential_cases = PotencialCase::whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->orWhere('responsible_id', $user->id) 
                ->get();
        }
    
        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $potential_cases = PotencialCase::where('created_by', $user->id)->get();
        }
    
        $appointments = Appointment::when($user->user_type == 'Super Responsable', function ($query) {
            return $query;
        })
        ->when($user->user_type == 'Responsable', function ($query) use ($user) {
            return $query->whereIn('created_by', function ($query) use ($user) {
                $query->select('id')
                    ->from('users')
                    ->where('responsible_id', $user->id)
                    ->whereIn('user_type', ['Admin', 'Commercial']);
            });
        })
        ->when($user->user_type == 'Admin' || $user->user_type == 'Commercial', function ($query) use ($user) {
            return $query->where('created_by', $user->id);
        })
        ->get();
    
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
        $user = auth()->user();
        $report = null;
    
        if ($user->user_type == 'Super Responsable') {
            $report = Report::with('creator', 'updater', 'potential_case', 'appointment')->findOrFail($id);
        }
    
        if ($user->user_type == 'Responsable') {
            $report = Report::with('creator', 'updater', 'potential_case', 'appointment')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->findOrFail($id);
        }
    
        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $report = Report::with('creator', 'updater', 'potential_case', 'appointment')
                ->where('created_by', $user->id)
                ->findOrFail($id);
        }
    
        if (!$report) {
            abort(403, 'Unauthorized action or report not found.');
        }
    
        return $report;
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
        $user = auth()->user();
        $report = null;

        if ($user->user_type == 'Super Responsable') {
            $report = Report::with('creator', 'updater', 'potential_case')->findOrFail($id);
        }
    
        if ($user->user_type == 'Responsable') {
            $report = Report::with('creator', 'updater', 'potential_case')
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->findOrFail($id);
        }
    
        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $report = Report::with('creator', 'updater', 'potential_case')
                ->where('created_by', $user->id)
                ->findOrFail($id);
        }
   
        if (!$report) {
            abort(403, 'Unauthorized action or report not found.');
        }
    
        try {
            $report->delete();
            return ['status' => 'success', 'message' => 'Report deleted successfully'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Error deleting report: ' . $e->getMessage()];
        }
    }
}
