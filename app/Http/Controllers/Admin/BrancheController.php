<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branche;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrancheController extends Controller
{
    public function get_all_branches()
    {

        $branches = Branche::with('creator', 'updater', 'service')->get();

        return view('branches.branches_list', compact('branches'));
    }

    public function add_branche()
    {

        $branches = Branche::with('creator', 'updater')->get();
        $services = Service::all();
        return view('branches.add_branche', compact('branches', 'services'));
    }


    public function store_branche(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'service_id' => 'required|exists:services,id',

        ], [
            'name.required' => 'Veuillez entrer le nom du poste.',
        ]);
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $branche = Branche::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'service_id' => $validatedData['service_id'],
                'created_by' => $user->id,
            ]);

            DB::commit();
            return redirect('/branches')->with('success', 'Branche created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return redirect('/ajouter-branche')->with('success', 'Branche not created');
        }
    }

    public function edit_branche($id)
    {

        $branche = Branche::with('creator', 'updater', 'service')->findOrFail($id);
        $services = Service::all();
        return view('branches.edit_branche', compact('branche', 'services'));
    }

    public function update_branche(Request $request, $id)
    {
        $branche = Branche::with('creator', 'updater', 'service')->findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'sometimes',
            'description' => 'nullable',
            'service_id' => 'sometimes|exists:services,id',

        ], [
            'name.sometimes' => 'Veuillez entrer le nom du poste.',

        ]);

        DB::beginTransaction();
        try {

            $user = Auth::user();
            $branche->name = $request->input('name');
            $branche->description = $request->input('description');
            $branche->service_id = $request->input('service_id');
            $branche->updated_by = $user->id;
            $branche->save();

            DB::commit();
            return redirect('/branches')->with('success', 'Branche updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return [
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ];
        }
    }

    public function delete_branche($id){
        $branche = Branche::with('creator', 'updater')->findOrFail($id);
        $branche->delete();
        return redirect('/branches')->with('success', 'Branche deleted successfully');
    }
}
