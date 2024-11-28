<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrancheRequest;
use App\Http\Requests\UpdateBrancheRequest;
use App\Services\BrancheService;
use Illuminate\Http\Request;

class BrancheApiController extends Controller
{
    protected $brancheService;

    public function __construct(BrancheService $brancheService)
    {
        $this->brancheService = $brancheService;
    }

    public function get_all_branches()
    {
        $branches = $this->brancheService->getAllBranches();
        return response()->json($branches);
    }

    public function add_branche()
    {
        $branches = $this->brancheService->getAllBranches();
        $services = $this->brancheService->getAllServices();
        return response()->json(compact('branches', 'services'));
    }

    public function store_branche(BrancheRequest $request)
    {
        $validatedData = $request->validated();

        $response = $this->brancheService->createBranche($validatedData);
        
        return response()->json([
            'status' => $response['status'],
            'message' => $response['message']
        ], $response['status'] == 'success' ? 201 : 400);
    }

    public function edit_branche($id)
    {
        $branche = $this->brancheService->getBrancheById($id);
        $services = $this->brancheService->getAllServices();

        if ($branche) {
            return response()->json(compact('branche', 'services'));
        }

        return response()->json(['error' => 'Branche not found'], 404);
    }

    public function update_branche(UpdateBrancheRequest $request, $id)
    {
        $validatedData = $request->validated();

        $response = $this->brancheService->updateBranche($id, $validatedData);
        
        return response()->json([
            'status' => $response['status'],
            'message' => $response['message']
        ], $response['status'] == 'success' ? 200 : 400);
    }

    public function delete_branche($id)
    {
        $response = $this->brancheService->deleteBranche($id);
        
        return response()->json([
            'status' => $response['status'],
            'message' => $response['message']
        ], $response['status'] == 'success' ? 200 : 400);
    }
}
