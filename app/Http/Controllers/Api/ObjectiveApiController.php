<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ObjectiveRequest;
use App\Http\Requests\UpdateObjectiveRequest;
use App\Services\ObjectiveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ObjectiveApiController extends Controller
{
    protected $objectiveService;

    public function __construct(ObjectiveService $objectiveService)
    {
        $this->objectiveService = $objectiveService;
    }

    public function get_all_objectives()
    {
        try {
            $objectives = $this->objectiveService->getAllObjectives();
            return response()->json(['status' => 'success', 'data' => $objectives], 200);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve objectives: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to retrieve objectives'], 500);
        }
    }

    public function add_objective()
    {
        try {
            $response = $this->objectiveService->addObjective();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $e) {
            Log::error('Failed to add objective: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to add objective'], 500);
        }
    }

    public function store_objective(ObjectiveRequest $request)
    {

        try {
            $this->objectiveService->createObjective($request);
            return response()->json(['status' => 'success', 'message' => 'Objective created successfully'], 201);
        } catch (\Exception $e) {
            Log::error('Objective creation failed: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Objective not created'], 400);
        }
    }

    public function display_objective($id)
    {
        try {
            $objective = $this->objectiveService->displayObjective($id);
            return response()->json(['status' => 'success', 'data' => $objective], 200);
        } catch (\Exception $e) {
            Log::error('Objective not found: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Objective not found'], 404);
        }
    }

    public function edit_objective($id)
    {
        try {
            $objective = $this->objectiveService->editObjective($id);
            return response()->json(['status' => 'success', 'data' => $objective], 200);
        } catch (\Exception $e) {
            Log::error('Objective not found: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Objective not found'], 404);
        }
    }

    public function update_objective(UpdateObjectiveRequest $request, $id)
    {

        try {
            $this->objectiveService->updateObjective($id, $request);
            return response()->json(['status' => 'success', 'message' => 'Objective updated successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Objective update failed: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Objective not updated'], 400);
        }
    }

    public function delete_objective($id)
    {
        try {
            $this->objectiveService->deleteObjective($id);
            return response()->json(['status' => 'success', 'message' => 'Objective deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to delete objective: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Objective not deleted'], 400);
        }
    }
}
