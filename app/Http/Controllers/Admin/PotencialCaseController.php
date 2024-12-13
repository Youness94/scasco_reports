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
            'case_name' => 'required',
            'client_id' => 'required|exists:clients,id',
            'branches' => 'required|array',
            'branches.*' => 'exists:branches,id',
            'branch_ca' => 'nullable|array',
            'branch_ca.*' => 'numeric|between:.01,999999999999.99',
        ], [
            'client_id.required' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client spécifié n\'existe pas.',
            'branches.*.exists' => 'Un ou plusieurs branches spécifiés n\'existent pas.',
            'branch_ca.array' => 'Les valeurs de branch_ca doivent être sous forme de tableau.',
            'branch_ca.*.numeric' => 'Le CA doit être un nombre valide.',
            'branch_ca.*.between' => 'Le CA doit être compris entre 0.01 et 999999999999.99.',
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
            'branches' => $potentialCase['branches'],
            'clients' => $potentialCase['clients'],
            'cities' => $potentialCase['cities'],
        ]);
    }

    public function update_potential_case(Request $request, $id)
    {
        Log::info('Entering update_potential_case method with ID: ' . $id);
        $validated =  $request->validate([
            'case_name' => 'sometimes',
            'client_id' => 'sometimes|exists:clients,id',
            'branches' => 'nullable|array',
            'branches.*' => 'exists:branches,id',
            'branch_ca' => 'nullable|array',
            'branch_ca.*' => 'numeric|between:.01,999999999999.99',
        ], [
            'client_id.sometimes' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client spécifié n\'existe pas.',
            'branches.*.exists' => 'Un ou plusieurs branches spécifiés n\'existent pas.',
            'branch_ca.array' => 'Les valeurs de branch_ca doivent être sous forme de tableau.',
            'branch_ca.*.numeric' => 'Le CA doit être un nombre valide.',
            'branch_ca.*.between' => 'Le CA doit être compris entre 0.01 et 999999999999.99.',
        ]);


        Log::info('Request validated successfully:', $validated);

        $result = $this->potentialCaseService->updatePotentialCase($request, $id);

        if ($result['status'] == 'success') {
            Log::info('Potential case updated successfully');
            return redirect('/affaires')->with('success', $result['message']);
        } else {
            Log::error('Failed to update potential case');
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
            'branches' => $potentialCase['branches'],
            'clients' => $potentialCase['clients'],
            'cities' => $potentialCase['cities'],
        ]);
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
            // return redirect()->back()->with('error', $result['message']);
            return redirect()->back()->with(['success' => true, 'message' => $response['message']]);
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

            return redirect()->back()->with(['success' => true, 'message' => $response['message']]);
        } catch (\Exception $e) {
            Log::error('Error in createCommentPotentialCase: ' . $e->getMessage());

            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }



    // public function createCommentPotentialCase(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'comment' => 'required|string',
    //     ], [
    //         'comment.required' => 'Le commentaire est obligatoire.',
    //         'comment.string' => 'Le commentaire doit être une chaîne de caractères valide.' 
    //     ]);
    //     try {
    //         $history = $this->potentialCaseService->storeComment($validatedData, $id);
    //         $commentHtml = view('potential_cases.comments', compact('history'))->render();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Commentaire created successfully',
    //         'comment_html' => $commentHtml,
    //     ], 201);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Comment not created: ' . $e->getMessage(),
    //         ], 400);
    //     }
    // }
}
