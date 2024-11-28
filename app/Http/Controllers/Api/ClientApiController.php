<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Services\ClientService;
use App\Models\City;
use Illuminate\Http\Request;

class ClientApiController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function get_all_clients()
    {
        $clients = $this->clientService->getAllClients();
        return response()->json($clients);
    }

    public function add_client()
    {
        $data = $this->clientService->addClient();
        return response()->json($data);
    }


    public function store_client(ClientRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $this->clientService->storeClient($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Client created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Client not created: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function edit_client($id)
    {
        $client = $this->clientService->getClient($id);
        if ($client) {
            $cities = City::all();
            return response()->json([
                'client' => $client,
                'cities' => $cities,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Client not found',
        ], 404);
    }

    public function update_client(UpdateClientRequest $request, $id)
    {
        $validatedData = $request->validated();

        try {
            $this->clientService->updateClient($id, $validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Client updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() ?: 'DB Error',
            ], 400);
        }
    }

    public function delete_client($id)
    {
        try {
            $this->clientService->deleteClient($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Client deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() ?: 'DB Error',
            ], 400);
        }
    }

    public function display_client($id)
    {
        $client = $this->clientService->getClient($id);
        if ($client) {
            return response()->json($client);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Client not found',
        ], 404);
    }
}
