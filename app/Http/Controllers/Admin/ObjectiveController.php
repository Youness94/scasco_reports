<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ObjectiveService;
use Illuminate\Support\Facades\Log;

class ObjectiveController extends Controller
{
    protected $objectiveService;

    public function __construct(ObjectiveService $objectiveService)
    {
        $this->objectiveService = $objectiveService;
    }
    public function get_all_objectives()
    {

        $objectives = $this->objectiveService->getAllObjectives();
        return view('objectives.objectives_list', compact('objectives'));
    }
    public function add_objective()
    {

        $response = $this->objectiveService->addObjective();

        return view('objectives.add_objective', $response);
    }

    public function store_objective(Request $request)
    {
        $request->validate([
            'year_objective' => 'required|numeric|between:.01,999999999999.99',
            // 'amount_realized' => 'nullable|numeric|between:.01,999999999999.99',
            // 'remaining_amount' => 'nullable|numeric|between:.01,999999999999.99',
            'commercial_id' => 'required|exists:users,id',
        ]);

        // $response = $this->objectiveService->createObjective($request);

        try {
            $this->objectiveService->createObjective($request);
            return redirect('/objectifs')->with('success', 'Objective created successfully');
        } catch (\Exception $e) {
            return redirect('/ajouter-objectif')->with('success', 'Objective not created');
        }
       
    }

    public function display_objective($id)
    {
        try {
            $objective = $this->objectiveService->displayObjective($id);
            return response()->json($objective, 200);
        } catch (\Exception $e) {
            Log::error('Objective not found: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Objective not found'], 404);
        }
    }
    public function edit_objective($id)
    {
        try {
            $objective = $this->objectiveService->editObjective($id);
            return response()->json($objective, 200);
        } catch (\Exception $e) {
            Log::error('Objective not found: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Objective not found'], 404);
        }
    }
    public function update_objective(Request $request, $id)
    {
        $request->validate([
            'year_objective' => 'sometimes|numeric|between:.01,999999999999.99',
            // 'amount_realized' => 'sometimes|numeric|between:.01,999999999999.99',
            // 'remaining_amount' => 'sometimes|numeric|between:.01,999999999999.99',
            'commercial_id' => 'sometimes|exists:users,id',
        ]);

        $response = $this->objectiveService->updateObjective($id, $request);

        if ($response['status'] == 'success') {
            return response()->json($response, 200);
        } else {
            return response()->json($response, 400);
        }
    }

    public function delete_objective($id)
    {
        try {
            $response = $this->objectiveService->deleteObjective($id);
            return response()->json($response, 200);
        } catch (\Exception $e) {
            Log::error('Failed to delete objective: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to delete objective'], 500);
        }
    }
}
