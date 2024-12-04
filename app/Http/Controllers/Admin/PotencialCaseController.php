<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Branche;
use App\Models\Client;
use App\Models\PotencialCase;
use App\Models\Service;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\PotentialCaseService;

class PotencialCaseController extends Controller
{
    protected $potentialCaseService;
    protected $clientService;
    public function __construct(PotentialCaseService $potentialCaseService, ClientService $clientService)
    {
        $this->potentialCaseService = $potentialCaseService;
        $this->clientService = $clientService;
    }



    public function get_all_potential_cases()
    {
        $all_potential_cases = $this->potentialCaseService->getAllPotentialCases();
        return view('potential_cases.potential_cases_list', compact('all_potential_cases'));
    }

    public function add_potential_case()
    {
        $data = $this->potentialCaseService->getAllClientsAndServices();
        return view('potential_cases.add_potential_case', $data);
    }

    public function store_potential_case(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
            'branches' => 'nullable|array',
            'branches.*' => 'exists:branches,id',
        ], [
            'client_id.required' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client spécifié n\'existe pas.',
            'services.required' => 'Les services sont obligatoires.',
            'services.array' => 'Les services doivent être fournis sous forme de tableau.',
            'services.*.exists' => 'Un ou plusieurs services spécifiés n\'existent pas.',
            'branches.array' => 'Les branches doivent être fournies sous forme de tableau.',
            'branches.*.exists' => 'Une ou plusieurs branches spécifiées n\'existent pas.',
        ]);

        $result = $this->potentialCaseService->storePotentialCase($request);

        if ($result['status'] == 'success') {
            return redirect('/affaires')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }


    public function edit_potential_case($id)
    {
        Log::info('Entering edit_potential_case method with ID: ' . $id);

        $potentialCase = $this->potentialCaseService->editPotentialCase($id);
        Log::info('Data for editing potential case:', ['potentialCase' => $potentialCase]);

        return view('potential_cases.edit_potential_case', [
            'potentialCase' => $potentialCase['potentialCase'],
            'services' => $potentialCase['services'],
            'clients' => $potentialCase['clients'],
            'cities' => $potentialCase['cities'],
        ]);
    }

    public function update_potential_case(Request $request, $id)
    {
        Log::info('Entering update_potential_case method with ID: ' . $id);

        $validated = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'services' => 'sometimes|array',
            'services.*' => 'exists:services,id',
            'branches' => 'nullable|array',
            'branches.*' => 'exists:branches,id',
        ], [
            'client_id.sometimes' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client spécifié n\'existe pas.',
            'services.sometimes' => 'Les services sont obligatoires.',
            'services.array' => 'Les services doivent être fournis sous forme de tableau.',
            'services.*.exists' => 'Un ou plusieurs services spécifiés n\'existent pas.',
            'branches.array' => 'Les branches doivent être fournies sous forme de tableau.',
            'branches.*.exists' => 'Une ou plusieurs branches spécifiées n\'existent pas.',
        ]);
        Log::info('Request validated successfully:', $validated);

        $result = $this->potentialCaseService->updatePotentialCase($request, $id);

        if ($result['status'] == 'success') {
            Log::info('Potential case updated successfully');
            return redirect('/affaires')->with('success', $result['message']);
        } else {
            Log::error('Failed to update potential case: ' . $result['message']);
            return redirect()->back()->with('error', $result['message']);
        }
    }
    public function store_client_potential_case(ClientRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $client = $this->clientService->storeClient($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Client created successfully',
                'client_id' => $client->id,
                'client_name' => $client->client_first_name . ' ' . $client->client_last_name,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Client not created: ' . $e->getMessage(),
            ], 400);
        }
    }
    public function getBranchesByService(Request $request)
    {
        $serviceIds = $request->input('service_ids');
        $services = $this->potentialCaseService->getBranchesByService($serviceIds);

        return response()->json($services);
    }


    public function editBranchesByService(Request $request)
    {
        $serviceId = $request->service_id;
    
        try {
            $result = $this->potentialCaseService->editBranchesByService($serviceId);
    
            return response()->json([
                'service_name' => $result['service_name'],
                'branches' => $result['branches']
            ]);
        } catch (\Exception $e) {
            Log::error('Error in editBranchesByService: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    
    public function updateBranchesForService(Request $request)
    {
        $serviceId = $request->service_id;
        $branchIds = $request->branch_ids; // array of branch IDs to associate with the service
    
        try {
            // Calling the service layer method to update the branches
            $this->potentialCaseService->updateBranchesForService($serviceId, $branchIds);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error in updateBranchesForService: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    
    public function removeBranchesFromService(Request $request)
    {
        $serviceId = $request->service_id;
    
        try {
    
            $this->potentialCaseService->removeBranchesFromService($serviceId);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error in removeBranchesFromService: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    
    public function delete_potential_case($id)
    {
        $result = $this->potentialCaseService->deletePotencialCase($id);
        if ($result['status'] == 'success') {
            return redirect('/affaires')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function display_potential_case($id)
    {
        Log::info('Entering display_potential_case method with ID: ' . $id);

        $potentialCase = $this->potentialCaseService->detailsPotentialCase($id);
        Log::info('Data for editing potential case:', ['potentialCase' => $potentialCase]);

        return view('potential_cases.potential_case_details', [
            'potentialCase' => $potentialCase['potentialCase'],
            'services' => $potentialCase['services'],
            'clients' => $potentialCase['clients'],
            'cities' => $potentialCase['cities'],
        ]);
    }
}
