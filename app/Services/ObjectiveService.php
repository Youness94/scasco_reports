<?php

namespace App\Services;

use App\Models\Branche;
use App\Models\Objective;
use App\Models\PotencialCase;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ObjectiveService
{
    public function getAllObjectives()
    {
        return Objective::with('creator', 'updater', 'commercial')->get();
    }

    public function addObjective()
    {
        return [
            'users' => User::all(),
        ];
    }
    public function createObjective($request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            // Check for an existing objective for this commercial and the current year
            $existingObjective = Objective::where('commercial_id', $request->input('commercial_id'))
                ->where('year', date('Y'))
                ->where('objective_status', 'available')
                ->first();

            if ($existingObjective) {
                $existingObjective->update([
                    'objective_status' => 'close',
                    'updated_by' => $user->id
                ]);
            }

            // Calculate the total amount realized
            $totalAmountRealized = PotencialCase::where('created_by', $request->input('commercial_id'))
                ->whereYear('created_at', date('Y'))
                ->where('case_status', 'completed')
                ->with('branches')
                ->get()
                ->flatMap(function ($case) {
                    // For each PotencialCase, collect all branch_ca values
                    return $case->branches->pluck('pivot.branch_ca');
                })
                ->sum();

            // Calculate the remaining amount
            $yearObjective = $request->input('year_objective');
            $remainingAmount = $yearObjective - $totalAmountRealized;

            // Create a new objective
            $objective = Objective::create([
                'year_objective' => $yearObjective,
                'amount_realized' => $totalAmountRealized,
                'remaining_amount' => $remainingAmount,
                'objective_status' => $request->input('objective_status') ?? 'available',
                'year' => date('Y'),
                'commercial_id' => $request->input('commercial_id'),
                'created_by' => $user->id,
            ]);

            DB::commit();
            return ['status' => 'success', 'message' => 'Objective created successfully'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Objective creation failed: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Objective not created'];
        }
    }

    public function editObjective($id)
    {
        return [
            'objective' => Objective::with('creator', 'updater', 'commercial')->findOrFail($id),
            'users' => User::all(),
            'objective_status' => ['available', 'close'] 
            
        ];
    }

    public function updateObjective($id, $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $objective = Objective::with('creator', 'updater', 'commercial')->findOrFail($id);


            $newCommercialId = $request->input('commercial_id', $objective->commercial_id);


            $totalAmountRealized = PotencialCase::where('created_by', $newCommercialId)
                ->whereYear('created_at', $objective->year)
                ->where('case_status', 'completed')
                ->with('branches')
                ->get()
                ->flatMap(function ($case) {
                    return $case->branches->pluck('pivot.branch_ca');
                })
                ->sum();

            // Calculate remaining_amount as year_objective - amount_realized
            $yearObjective = $request->input('year_objective', $objective->year_objective);
            $remainingAmount = $yearObjective - $totalAmountRealized;

            if ($objective->commercial_id != $newCommercialId) {
                $previousObjective = Objective::where('commercial_id', $objective->commercial_id)
                    ->where('year', $objective->year)
                    ->where('objective_status', 'available')
                    ->first();

                if ($previousObjective) {
                    $previousObjective->update([
                        'objective_status' => 'close',
                        'updated_by' => $user->id
                    ]);
                }

                $newObjective = Objective::where('commercial_id', $newCommercialId)
                    ->where('year', $objective->year)
                    ->where('objective_status', 'available')
                    ->first();

                if ($newObjective) {
                    $newObjective->update([
                        'objective_status' => 'close',
                        'updated_by' => $user->id
                    ]);
                }
            }

            $objective->update([
                'year_objective' => $yearObjective,
                'amount_realized' => $totalAmountRealized,
                'remaining_amount' => $remainingAmount,
                'commercial_id' => $newCommercialId,
                'objective_status' => $request->input('objective_status') ?? $objective->objective_status, 
                'updated_by' => $user->id,
            ]);

            DB::commit();
            return ['status' => 'success', 'message' => 'Objective updated successfully'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Objective update failed: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }


    public function displayObjective($id)
    {
        return Objective::with('creator', 'updater', 'commercial')->findOrFail($id);
    }
    public function deleteObjective($id)
    {
        $objective = Objective::with('creator', 'updater', 'commercial')->findOrFail($id);
        $objective->delete();
        return ['status' => 'success', 'message' => 'Objective deleted successfully'];
    }
}
