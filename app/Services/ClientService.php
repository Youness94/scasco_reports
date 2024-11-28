<?php

namespace App\Services;

use App\Models\City;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientService
{
    public function getAllClients()
    {
        return Client::with('creator', 'updater', 'client_infos', 'city')->get();
    }

    public function addClient()
    {
        return [
            'clients' => Client::with('creator', 'updater', 'client_infos', 'city')->get(),
            'cities' => City::all()
        ];
    }

    public function storeClient($validatedData)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $client = Client::create([
                'client_first_name' => $validatedData['client_first_name'],
                'client_last_name' => $validatedData['client_last_name'],
                'client_address' => $validatedData['client_address'],
                'client_phone' => $validatedData['client_phone'],
                'client_email' => $validatedData['client_email'],
                'RC' => $validatedData['RC'],
                'ICE' => $validatedData['ICE'],
                'client_type' => $validatedData['client_type'] ?? 'Particulier',
                'city_id' => $validatedData['city_id'],
                'created_by' => $user->id,
            ]);

            DB::commit();
            return $client;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Client creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getClient($id)
    {
        return Client::with('creator', 'updater', 'client_infos', 'city')->findOrFail($id);
    }

    public function updateClient($id, $validatedData)
    {
        $client = $this->getClient($id);

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $client->update([
                'client_first_name' => $validatedData['client_first_name'] ?? $client->client_first_name,
                'client_last_name' => $validatedData['client_last_name'] ?? $client->client_last_name,
                'client_address' => $validatedData['client_address'] ?? $client->client_address,
                'client_phone' => $validatedData['client_phone'] ?? $client->client_phone,
                'client_email' => $validatedData['client_email'] ?? $client->client_email,
                'RC' => $validatedData['RC'] ?? $client->RC,
                'ICE' => $validatedData['ICE'] ?? $client->ICE,
                'client_type' => $validatedData['client_type'] ?? $client->client_type,
                'city_id' => $validatedData['city_id'] ?? $client->city_id,
                'updated_by' => $user->id,
            ]);

            DB::commit();
            return $client;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Client update failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteClient($id)
    {
        $client = $this->getClient($id);
        $client->delete();
    }
}
