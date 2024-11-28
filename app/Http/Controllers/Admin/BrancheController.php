<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BrancheService;
use Illuminate\Http\Request;

class BrancheController extends Controller
{
    protected $brancheService;

    public function __construct(BrancheService $brancheService)
    {
        $this->brancheService = $brancheService;
    }

    public function get_all_branches()
    {
        $branches = $this->brancheService->getAllBranches();
        return view('branches.branches_list', compact('branches'));
    }

    public function add_branche()
    {
        $branches = $this->brancheService->getAllBranches();
        $services = $this->brancheService->getAllServices();
        return view('branches.add_branche', compact('branches', 'services'));
    }

    public function store_branche(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'service_id' => 'required|exists:services,id',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'description.nullable' => 'La description est optionnelle.',
            'service_id.required' => 'L\'ID du service est obligatoire.',
            'service_id.exists' => 'Le service avec cet ID n\'existe pas.',
        ]);

        $response = $this->brancheService->createBranche($validatedData);
        return redirect('/branches')->with($response['status'], $response['message']);
    }

    public function edit_branche($id)
    {
        $branche = $this->brancheService->getBrancheById($id);
        $services = $this->brancheService->getAllServices();
        return view('branches.edit_branche', compact('branche', 'services'));
    }

    public function update_branche(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes',
            'description' => 'nullable',
            'service_id' => 'sometimes|exists:services,id',
        ], [
            'name.sometimes' => 'Le nom est obligatoire.',
            'description.nullable' => 'La description est optionnelle.',
            'service_id.sometimes' => 'L\'ID du service est obligatoire.',
            'service_id.exists' => 'Le service avec cet ID n\'existe pas.',
        ]);

        $response = $this->brancheService->updateBranche($id, $validatedData);
        return redirect('/branches')->with($response['status'], $response['message']);
    }

    public function delete_branche($id)
    {
        $response = $this->brancheService->deleteBranche($id);
        return redirect('/branches')->with($response['status'], $response['message']);
    }
}
