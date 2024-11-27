<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PotencialCase;
use App\Models\Report;
use App\Services\PotencialCaseHisotryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{

    protected $potencialCaseHisotryService;
    public function __construct(PotencialCaseHisotryService $potencialCaseHisotryService)
    {
        $this->potencialCaseHisotryService = $potencialCaseHisotryService;
    }
    public function get_all_reports()
    {

        $reports = Report::with('creator', 'updater', 'potential_case','appointment' )->get();

        return view('reports.reports_list', compact('reports'));
    }

    public function get_appointments_by_case($potencial_case_id)
    {
        $appointments = Appointment::where('potencial_case_id', $potencial_case_id)->get();

        return response()->json($appointments);
    }

    public function add_report()
    {

        $potential_cases = PotencialCase::all();
        $appointments = Appointment::all();
        Log::info('potential_cases ' . $potential_cases);
        return view('reports.add_report', compact('potential_cases', 'appointments'));
    }


    public function store_report(Request $request)
    {
        $validatedData = $request->validate([
            'contenu' => 'required',
            'potencial_case_id' => 'required|exists:potencial_cases,id',
            'appointment_id' => 'nullable|exists:appointments,id',

        ], []);
        DB::beginTransaction();
        try {
            $potentialCase = PotencialCase::with('client')->findOrFail($validatedData['potencial_case_id']);
            $user = Auth::user();
            $report = Report::create([
                'date_report' => now(),
                'contenu' => $validatedData['contenu'],
                'potencial_case_id' => $validatedData['potencial_case_id'],
                'appointment_id' => $validatedData['appointment_id'],
                'created_by' => $user->id,
            ]);
            $this->potencialCaseHisotryService->createHistoryRecord(
                'report_added', 
                'Report added to the case', 
                $potentialCase, 
                null, 
                $report->id, 
                Auth::id()
            );
            DB::commit();
            return redirect('/comptes-rendus')->with('success', 'Report created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return redirect('/ajouter-compte-rendu')->with('success', 'Report not created');
        }
    }

    public function edit_report($id)
    {

        $report = Report::with('creator', 'updater', 'potential_case', 'appointment')->findOrFail($id);
        $potential_cases = PotencialCase::all();
        $appointments = Appointment::all();
        return view('reports.edit_report', compact('report', 'potential_cases', 'appointments'));
    }

    public function update_report(Request $request, $id)
    {
        $report = Report::with('creator', 'updater', 'potential_case', 'appointment')->findOrFail($id);
        $validatedData = $request->validate([
            'contenu' => 'sometimes',
            'potencial_case_id' => 'sometimes|exists:potencial_cases,id',
            'appointment_id' => 'sometimes|exists:appointments,id',
        ], []);

        DB::beginTransaction();
        try {

            $user = Auth::user();
            $report->contenu = $request->input('contenu');
            $report->potencial_case_id = $request->input('potencial_case_id');
            $report->appointment_id = $request->input('appointment_id');
            $report->updated_by = $user->id;
            $report->save();
            $this->potencialCaseHisotryService->createHistoryRecord('updated', 'Report updated', $report->potential_case, null, $report->id, $user->id);
            DB::commit();
            return redirect('/comptes-rendus')->with('success', 'Report updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return [
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ];
        }
    }

    public function delete_report($id)
    {
        $report = Report::with('creator', 'updater', 'potential_case')->findOrFail($id);
        $report->delete();
        return redirect('/comptes-rendus')->with('success', 'Report deleted successfully');
    }
}
