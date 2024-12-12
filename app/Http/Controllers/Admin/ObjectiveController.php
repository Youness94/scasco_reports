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
            'year_objective' => 'required|numeric|min:0.01|max:999999999999.99',
            // 'amount_realized' => 'nullable|numeric|between:.01,999999999999.99',
            // 'remaining_amount' => 'nullable|numeric|between:.01,999999999999.99',
            'commercial_id' => 'required|exists:users,id',
        ], [
            'year_objective.required' => 'L\'objectif annuel est obligatoire.',
            'year_objective.numeric' => 'L\'objectif annuel doit être un nombre.',
            'year_objective.min' => 'L\'objectif annuel doit être au moins 0.01.',
            'year_objective.max' => 'L\'objectif annuel ne peut pas dépasser 999999999999.99.',
            'commercial_id.required' => 'L\'identifiant commercial est obligatoire.',
            'commercial_id.exists' => 'L\'identifiant commercial sélectionné n\'existe pas.',
        ]);

        // $response = $this->objectiveService->createObjective($request);

        try {
            $this->objectiveService->createObjective($request);
            return redirect('/objectifs')->with('success', 'Objective created successfully');
        } catch (\Exception $e) {
            Log::error('Objective creation failed: ' . $e->getMessage());  // Log the error
            return redirect('/ajouter-objectif')->with('error', 'Objective not created');
        }
       
    }

    public function display_objective($id)
    {
        try {
            $objective = $this->objectiveService->displayObjective($id);
            return view('objectives.objective_details.', $objective);
        } catch (\Exception $e) {
            Log::error('Objective not found: ' . $e->getMessage());
            return redirect('/objectifs')->with('error', 'Objective not ');
        }
    }
    public function edit_objective($id)
{
    try {
        $objective = $this->objectiveService->editObjective($id);
        return view('objectives.edit_objective', $objective);
    } catch (\Exception $e) {
        Log::error('Objective not found: ' . $e->getMessage());
        return redirect('/objectifs')->with('error', 'Objective not found');
    }
}
    public function update_objective(Request $request, $id)
    {
        $request->validate([
            'year_objective' => 'sometimes|numeric|between:.01,999999999999.99',
            // 'amount_realized' => 'sometimes|numeric|between:.01,999999999999.99',
            // 'remaining_amount' => 'sometimes|numeric|between:.01,999999999999.99',
            'commercial_id' => 'sometimes|exists:users,id',
        ], [
            'year_objective.sometimes' => 'L\'objectif annuel est obligatoire si présent.',
            'year_objective.numeric' => 'L\'objectif annuel doit être un nombre.',
            'year_objective.between' => 'L\'objectif annuel doit être entre 0.01 et 999999999999.99.',
            // 'amount_realized.sometimes' => 'Le montant réalisé est obligatoire si présent.',
            // 'amount_realized.numeric' => 'Le montant réalisé doit être un nombre.',
            // 'amount_realized.between' => 'Le montant réalisé doit être entre 0.01 et 999999999999.99.',
            // 'remaining_amount.sometimes' => 'Le montant restant est obligatoire si présent.',
            // 'remaining_amount.numeric' => 'Le montant restant doit être un nombre.',
            // 'remaining_amount.between' => 'Le montant restant doit être entre 0.01 et 999999999999.99.',
            'commercial_id.sometimes' => 'L\'identifiant commercial est obligatoire si présent.',
            'commercial_id.exists' => 'L\'identifiant commercial sélectionné n\'existe pas.',
        ]);

        // $response = $this->objectiveService->updateObjective($id, $request);

        try {
            $this->objectiveService->updateObjective($id, $request);
            return redirect('/objectifs')->with('success', 'Objective created successfully');
        } catch (\Exception $e) {
            Log::error('Objective creation failed: ' . $e->getMessage());  // Log the error
            return redirect('/modifer-objectif')->with('error', 'Objective not created');
        }
    }

    public function delete_objective($id)
    {
        try {
            $response = $this->objectiveService->deleteObjective($id);
            return redirect('/objectifs')->with('success', 'Objective deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete objective: ' . $e->getMessage());
            return redirect('/objectifs')->with('error', 'Objective not ');
        }
    }
}
