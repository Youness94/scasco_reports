<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PotencialCase;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function get_all_reports()
    {

        $reports = Report::with('creator', 'updater', 'potential_case')->get();

        return view('reports.reports_list', compact('reports'));
    }

    public function add_report()
    {

        $potential_cases = PotencialCase::all();
        Log::info('potential_cases '. $potential_cases);
        return view('reports.add_report', compact('potential_cases'));
    }


    public function store_report(Request $request)
    {
        $validatedData = $request->validate([
            'contenu' => 'required',
            'potencial_case_id' => 'required|exists:potencial_cases,id',

        ], [
           
        ]);
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $report = Report::create([
                'date_report' => now(),
                'contenu' => $validatedData['contenu'],
                'potencial_case_id' => $validatedData['potencial_case_id'],
                'created_by' => $user->id,
            ]);

            DB::commit();
            return redirect('/comptes-rendus')->with('success', 'Report created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return redirect('/ajouter-report')->with('success', 'Report not created');
        }
    }

    public function edit_report($id)
    {

        $report = Report::with('creator', 'updater', 'potential_case')->findOrFail($id);
        $potential_cases = PotencialCase::all();
        return view('reports.edit_report', compact('report', 'potential_cases'));
    }

    public function update_report(Request $request, $id)
    {
        $report = Report::with('creator', 'updater', 'potential_case')->findOrFail($id);
        $validatedData = $request->validate([
            'contenu' => 'required',
            'potencial_case_id' => 'required|exists:potencial_cases,id',

        ], [
           

        ]);

        DB::beginTransaction();
        try {

            $user = Auth::user();
            $report->contenu = $request->input('contenu');
            $report->potencial_case_id = $request->input('potencial_case_id');
            $report->updated_by = $user->id;
            $report->save();

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

    public function delete_report($id){
        $report = Report::with('creator', 'updater', 'potential_case')->findOrFail($id);
        $report->delete();
        return redirect('/comptes-rendus')->with('success', 'Report deleted successfully');
    }
}
