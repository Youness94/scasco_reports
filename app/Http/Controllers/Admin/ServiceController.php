<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function get_all_services()
    {

        $services = Service::with('creator', 'updater')->get();

        return view('services.services_list', compact('services'));
    }

    public function add_service()
    {

        $services = Service::with('creator', 'updater')->get();

        return view('services.add_service', compact('services'));
    }


    public function store_service(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',


        ], [
            'name.required' => 'Veuillez entrer le nom du poste.',
        ]);
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $service = Service::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'created_by' => $user->id,
            ]);

            DB::commit();
            return redirect('/services')->with('success', 'Service created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return redirect('/ajouter-service')->with('success', 'Service not created');
        }
    }

    public function edit_service($id)
    {

        $service = Service::with('creator', 'updater')->findOrFail($id);

        return view('services.edit_service', compact('service'));
    }

    public function update_service(Request $request, $id)
    {
        $service = Service::with('creator', 'updater')->findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'sometimes',


        ], [
            'name.sometimes' => 'Veuillez entrer le nom du poste.',

        ]);

        DB::beginTransaction();
        try {

            $user = Auth::user();
            $service->name = $request->input('name');
            $service->description = $request->input('description');
            $service->updated_by = $user->id;
            $service->save();

            DB::commit();
            return redirect('/services')->with('success', 'Service updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return [
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ];
        }
    }

    public function delete_service($id){
        $service = Service::with('creator', 'updater' ,'branches')->findOrFail($id);
        $service->delete();
        return redirect('/services')->with('success', 'Service deleted successfully');
    }
}
