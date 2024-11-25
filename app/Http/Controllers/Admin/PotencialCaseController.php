<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branche;
use App\Models\Client;
use App\Models\PotencialCase;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PotencialCaseController extends Controller
{
    public function get_all_potential_cases(){
        $all_potential_cases = PotencialCase::with('creator', 'updater','services','client')->get();
        return view('potential_cases.potential_cases_list', compact('all_potential_cases'));
    }

    public function add_potential_case(){
        $services = Service::with('branches')->get();
        $clients = Client::all();

        return view('potential_cases.add_potential_case', compact('clients', 'services'));
    }
    public function getBranchesByService(Request $request) {
        $serviceIds = $request->input('service_ids');
        
        // Get branches for the selected services
        $branches = Branche::whereIn('service_id', $serviceIds)->get();
    
        // Return branches as a JSON response
        return response()->json($branches);
    }
    public function store_potential_case(Request $request)
    {
        // Validate the incoming request (you may adjust validation rules as needed)
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'services' => 'required|array',  
            'services.*' => 'exists:services,id', 
            'branches' => 'nullable|array',  
            'branches.*' => 'exists:branches,id', 
        ]);
        DB::beginTransaction();
        try {

            $user = Auth::user();
            $lastPotentialCaseNumber = DB::table('potential_case_sequences')->first();
            if ($lastPotentialCaseNumber === null) {
                  $newPotentialCaseNumber = 1;
                  DB::table('potential_case_sequences')->insert(['last_potential_case_number' => $newPotentialCaseNumber]);
            } else {
                  $newPotentialCaseNumber = $lastPotentialCaseNumber->last_potential_case_number + 1;
                  DB::table('potential_case_sequences')->update(['last_potential_case_number' => $newPotentialCaseNumber]);
            }
            $generated_number = 'DEV-' . str_pad($newPotentialCaseNumber, 6, '0', STR_PAD_LEFT);
            
            // Create a new PotentialCase 
            $potentialCase = PotencialCase::create([
                'case_number' =>   $generated_number,
                'case_status' => 'pending', 
                'client_id' => $request->input('client_id'),
                'created_by' =>    $user->id, 
            ]);

            //  selected services
            foreach ($request->services as $serviceId) {
                $service = Service::findOrFail($serviceId);

                // Get the branch IDs related to the service (if any branches are selected)
                $selectedBranches = $request->branches ?: []; // If no branches selected, use an empty array

                // Store the relationship in the pivot table, with branch_ids as a JSON array
                $potentialCase->services()->attach($serviceId, [
                    'branch_ids' => json_encode($selectedBranches) // Store selected branch IDs as JSON
                ]);
            }

            DB::commit();
            return redirect('/affaires')->with('success', 'Business updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return [
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ];
        }
    }
}
