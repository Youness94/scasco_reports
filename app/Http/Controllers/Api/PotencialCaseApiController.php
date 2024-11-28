<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PotencialCaseRequest;
use App\Http\Requests\UpdatePotencialCaseRequest;
use App\Services\PotentialCaseService;
use App\Models\PotentialCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PotencialCaseApiController extends Controller
{
    protected $potentialCaseService;

    public function __construct(PotentialCaseService $potentialCaseService)
    {
        $this->potentialCaseService = $potentialCaseService;
    }

    public function get_all_potential_cases()
    {
        $all_potential_cases = $this->potentialCaseService->getAllPotentialCases();
        return response()->json($all_potential_cases);
    }
    public function add_potential_case()
    {
        $data = $this->potentialCaseService->getAllClientsAndServices();

        return response()->json($data);
    }
    public function store_potential_case(PotencialCaseRequest $request)
    {
        $validatedData = $request->validated();

        $result = $this->potentialCaseService->storePotentialCase($request);

        if ($result['status'] == 'success') {
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $result['message'],
            ], 400);
        }
    }

    public function edit_potential_case($id)
    {
        Log::info('Entering editPotentialCase method with ID: ' . $id);

        $potentialCase = $this->potentialCaseService->editPotentialCase($id);
        Log::info('Data for editing potential case:', ['potentialCase' => $potentialCase]);

        if ($potentialCase) {
            return response()->json([
                'potentialCase' => $potentialCase['potentialCase'],
                'services' => $potentialCase['services'],
                'clients' => $potentialCase['clients']
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Potential case not found',
        ], 404);
    }

    public function update_potential_case(UpdatePotencialCaseRequest $request, $id)
    {
        Log::info('Entering updatePotentialCase method with ID: ' . $id);

        $validatedData = $request->validated();
        Log::info('Request validated successfully:', $validatedData);

        $result = $this->potentialCaseService->updatePotentialCase($request, $id);

        if ($result['status'] == 'success') {
            Log::info('Potential case updated successfully');
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
            ]);
        } else {
            Log::error('Failed to update potential case: ' . $result['message']);
            return response()->json([
                'status' => 'error',
                'message' => $result['message'],
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
        $result = $this->potentialCaseService->getBranchesByService($serviceId);

        return response()->json([
            'service_name' => $result['service_name'],
            'branches' => $result['branches']
        ]);
    }

    public function updateBranchesForService(Request $request)
    {
        $serviceId = $request->service_id;
        $branchIds = $request->branch_ids;

        $this->potentialCaseService->updateBranchesForService($serviceId, $branchIds);

        return response()->json(['success' => true]);
    }

    public function removeBranchesFromService(Request $request)
    {
        $serviceId = $request->service_id;

        $this->potentialCaseService->removeBranchesFromService($serviceId);

        return response()->json(['success' => true]);
    }

    public function delete_potential_case($id)
    {
        $result = $this->potentialCaseService->deletePotencialCase($id);

        if ($result['status'] == 'success') {
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $result['message'],
            ], 400);
        }
    }
}
