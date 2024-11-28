<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function get_all_clients()
    {
        $clients = $this->clientService->getAllClients();
        return view('clients.clients_list', compact('clients'));
    }

    public function add_client()
    {
        $data = $this->clientService->addClient();
        return view('clients.add_client', $data);
    }

    public function store_client(Request $request)
    {
        $validatedData = $request->validate([
            'client_first_name' => 'required',
            'client_last_name' => 'required',
            'client_address' => 'required',
            'client_phone' => 'required',
            'client_email' => 'required',
            'RC' => 'nullable',
            'ICE' => 'nullable',
            'client_type' => 'required',
            'city_id' => 'required|exists:cities,id',
        ], [
            'client_first_name.required' => 'Le prénom du client est obligatoire.',
            'client_last_name.required' => 'Le nom du client est obligatoire.',
            'client_address.required' => 'L\'adresse du client est obligatoire.',
            'client_phone.required' => 'Le téléphone du client est obligatoire.',
            'client_email.required' => 'L\'email du client est obligatoire.',
            'RC.nullable' => 'Le numéro RC est optionnel.',
            'ICE.nullable' => 'Le numéro ICE est optionnel.',
            'client_type.required' => 'Le type de client est obligatoire.',
            'city_id.required' => 'La ville est obligatoire.',
            'city_id.exists' => 'La ville sélectionnée n\'existe pas.',
        ]);

        try {
            $this->clientService->storeClient($validatedData);
            return redirect('/clients')->with('success', 'Client created successfully');
        } catch (\Exception $e) {
            return redirect('/ajouter-client')->with('success', 'Client not created');
        }
    }

    public function edit_client($id)
    {
        $client = $this->clientService->getClient($id);
        $cities = City::all();
        return view('clients.edit_client', compact('client', 'cities'));
    }

    public function update_client(Request $request, $id)
    {
        $validatedData = $request->validate([
            'client_first_name' => 'sometimes',
            'client_last_name' => 'sometimes',
            'client_address' => 'sometimes',
            'client_phone' => 'sometimes',
            'client_email' => 'sometimes',
            'RC' => 'nullable',
            'ICE' => 'nullable',
            'client_type' => 'sometimes',
            'city_id' => 'sometimes|exists:cities,id',
        ], [
            'client_first_name.sometimes' => 'Le prénom du client est obligatoire.',
            'client_last_name.sometimes' => 'Le nom du client est obligatoire.',
            'client_address.sometimes' => 'L\'adresse du client est obligatoire.',
            'client_phone.sometimes' => 'Le téléphone du client est obligatoire.',
            'client_email.sometimes' => 'L\'email du client est obligatoire.',
            'RC.nullable' => 'Le numéro RC est optionnel.',
            'ICE.nullable' => 'Le numéro ICE est optionnel.',
            'client_type.sometimes' => 'Le type de client est obligatoire.',
            'city_id.sometimes' => 'La ville est obligatoire.',
            'city_id.exists' => 'La ville sélectionnée n\'existe pas.',
        ]);

        try {
            $this->clientService->updateClient($id, $validatedData);
            return redirect('/clients')->with('success', 'Client updated successfully');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ]);
        }
    }

    public function delete_client($id)
    {
        try {
            $this->clientService->deleteClient($id);
            return redirect('/clients')->with('success', 'Client deleted successfully');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ]);
        }
    }

    public function display_client($id)
    {
        $client = $this->clientService->getClient($id);
        return view('clients.client_details', compact('client'));
    }
}