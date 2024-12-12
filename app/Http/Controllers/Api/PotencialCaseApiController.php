<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\PotencialCaseRequest;
use App\Http\Requests\UpdatePotencialCaseRequest;
use App\Services\PotentialCaseService;
use App\Models\PotentialCase;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PotencialCaseApiController extends Controller
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

    public function display_potential_case($id)
    {
        Log::info('Entering displayPotentialCase method with ID: ' . $id);

        try {
            $potentialCase = $this->potentialCaseService->detailsPotentialCase($id);
            Log::info('Data for editing potential case:', ['potentialCase' => $potentialCase]);

            return response()->json([
                'potentialCase' => $potentialCase['potentialCase'],
                'branches' => $potentialCase['branches'],
                'clients' => $potentialCase['clients'],
                'cities' => $potentialCase['cities'],
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in displayPotentialCase: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function createCommentPotentialCase(Request $request, $id)
    {
        // Validate incoming request
        $validated = $request->validate([
            'comment' => 'required|string',
        ], [
            'comment.required' => 'Le commentaire est obligatoire.',
            'comment.string' => 'Le commentaire doit être une chaîne de caractères valide.'
        ]);

        try {
            $response = $this->potentialCaseService->createCommentPotentialCase($validated, $id);

            // Return success response with the comment
            return response()->json(['success' => true, 'message' => $response['message']], 200);
        } catch (\Exception $e) {
            Log::error('Error in createCommentPotentialCase: ' . $e->getMessage());

            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function updateStatusPotentialCase(Request $request, $id)
    {
        // Validate incoming request
        $validated = $request->validate([
            'case_status' => 'required|in:pending,completed,processing,cancelled',
        ], [
            'case_status.required' => 'Le statut est obligatoire.',
            'case_status.in' => 'Le statut sélectionné n\'est pas valide.',
        ]);

        try {
            $response = $this->potentialCaseService->updateStatusPotentialCase($validated, $id);

            return response()->json(['success' => true, 'message' => $response['message']], 200);
        } catch (\Exception $e) {
            Log::error('Error in updateStatusPotentialCase: ' . $e->getMessage());

            return response()->json(['error' => 'Something went wrong'], 500);
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
            Log::error('Error in storeClientPotentialCase: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Client not created: ' . $e->getMessage(),
            ], 400);
        }
    }
}
