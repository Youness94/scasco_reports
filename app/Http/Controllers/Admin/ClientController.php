<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class ClientController extends Controller
{
    public function get_all_clients()
    {

        $clients = Client::with('creator', 'updater', 'client_infos')->get();

        return view('clients.clients_list', compact('clients'));
    }

    public function add_client()
    {

        $clients = Client::with('creator', 'updater', 'city')->get();
        $cities = City::all();
        return view('clients.add_client', compact('clients', 'cities'));
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
            'name.required' => 'Veuillez entrer le nom du poste.',
        ]);
        DB::beginTransaction();
        try {
            // dd($request);
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
            return redirect('/clients')->with('success', 'Client created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return redirect('/ajouter-client')->with('success', 'Client not created');
        }
    }

    public function edit_client($id)
    {

        $client = Client::with('creator', 'updater', 'city')->findOrFail($id);
        $cities = City::all();
        return view('clients.edit_client', compact('client', 'cities'));
    }

    public function update_client(Request $request, $id)
    {
        $client = Client::with('creator', 'updater', 'city')->findOrFail($id);
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
            'name.sometimes' => 'Veuillez entrer le nom du poste.',

        ]);

        DB::beginTransaction();
        try {

            $user = Auth::user();
            $client->client_first_name = $request->input('client_first_name');
            $client->client_last_name = $request->input('client_last_name');
            $client->client_address = $request->input('client_address');
            $client->client_phone = $request->input('client_phone');
            $client->client_email = $request->input('client_email');
            $client->RC = $request->input('RC');
            $client->ICE = $request->input('ICE');
            $client->client_type = $request->input('client_type');
            $client->city_id = $request->input('city_id');
            $client->updated_by = $user->id;
            $client->save();

            DB::commit();
            return redirect('/clients')->with('success', 'Client updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return [
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ];
        }
    }

    public function delete_client($id){
        $client = Client::with('creator', 'updater')->findOrFail($id);
        $client->delete();
        return redirect('/clients')->with('success', 'Client deleted successfully');
    }
}
