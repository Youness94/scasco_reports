<?php


namespace App\Services;

use App\Http\Requests\ClientRequest;
use App\Models\Branche;
use App\Models\City;
use App\Models\Client;
use App\Models\Objective;
use App\Models\PotencialCase;
use App\Models\PotencialCaseHisotry;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PotentialCaseService
{
    protected $potencialCaseHisotryService;
    public function __construct(PotencialCaseHisotryService $potencialCaseHisotryService)
    {
        $this->potencialCaseHisotryService = $potencialCaseHisotryService;
    }
    public function getAllPotentialCases()
    {
        $user = auth()->user();

        if ($user->user_type == 'Super Responsable') {
            return PotencialCase::with(['creator', 'updater', 'client', 'branches'])->get();
        }

        if ($user->user_type == 'Responsable') {
            return PotencialCase::with(['creator', 'updater', 'client', 'branches'])
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->get();
        }
        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {

            return PotencialCase::with(['creator', 'updater', 'client', 'branches'])
                ->where('created_by', $user->id)
                ->get();
        }

        return PotencialCase::none();
    }

    public function getAllClientsAndServices()
    {
        // $services = Service::with('branches')->get();
        $branches = Branche::all();
        $clients = Client::all();
        $cities = City::all();
        return compact('clients', 'branches', 'cities');
    }

    public function storePotentialCase($request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            // Generate a unique case number
            $lastPotentialCaseNumber = DB::table('potential_case_sequences')->first();
            $newPotentialCaseNumber = $lastPotentialCaseNumber ? $lastPotentialCaseNumber->last_potential_case_number + 1 : 1;
            DB::table('potential_case_sequences')->updateOrInsert(
                ['id' => 1],
                ['last_potential_case_number' => $newPotentialCaseNumber]
            );
            $generated_number = 'A-' . str_pad($newPotentialCaseNumber, 6, '0', STR_PAD_LEFT);

            $totalCapital = 0;

            $potentialCase = PotencialCase::create([
                'case_name' => $request->input('case_name'),
                'case_number' => $generated_number,
                'case_status' => 'pending',
                'case_capital' => 0,
                'client_id' => $request->input('client_id'),
                'created_by' => $user->id,
            ]);

            if ($request->has('branches') && $request->has('branch_ca')) {
                $branches = $request->input('branches');
                $branchCaValues = $request->input('branch_ca');

                foreach ($branches as $branchId) {

                    $branchCaValue = $branchCaValues[$branchId] ?? null;

                    if ($branchCaValue) {

                        $totalCapital += $branchCaValue;

                        $potentialCase->branches()->attach($branchId, [
                            'branch_ca' => $branchCaValue,
                        ]);
                    }
                }
            }

            // Update the case capital with the total capital from all branches
            $potentialCase->update(['case_capital' => $totalCapital]);

            // Create a history record
            $this->potencialCaseHisotryService->createHistoryRecord(
                'created',
                'L\'affaire créé',
                $potentialCase,
                null,
                null,
                $user->id
            );

            DB::commit();

            return ['status' => 'success', 'message' => 'L\'affaire a été créé avec succès'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Potential case creation failed: ' . $e->getMessage());

            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }


    public function editPotentialCase($id)
    {
        $user = auth()->user();
        $potentialCase = null;

        if ($user->user_type == 'Super Responsable') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches'])->findOrFail($id);
        }

        if ($user->user_type == 'Responsable') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches'])
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->findOrFail($id);
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches'])
                ->where('created_by', $user->id)
                ->findOrFail($id);
        }


        if (!$potentialCase) {
            abort(404, 'Potential Case not found');
        }


        $branches = Branche::all();
        $clients = Client::all();
        $cities = City::all();
        return [
            'potentialCase' => $potentialCase,
            'branches' => $branches,
            'clients' => $clients,
            'cities' => $cities,
        ];
    }

    public function updatePotentialCase($request, $id)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches'])->findOrFail($id);

            if ($potentialCase->case_status == 'completed') {
                $commercialId = $potentialCase->created_by;
                $year = date('Y');

                $totalAmountRealized = PotencialCase::where('created_by', $commercialId)
                    ->whereYear('created_at', $year)
                    ->with('branches')
                    ->get()
                    ->flatMap(function ($case) {
                        return $case->branches->pluck('pivot.branch_ca');
                    })
                    ->sum();

                $objective = Objective::where('commercial_id', $commercialId)
                    ->where('year', $year)
                    ->first();

                if ($objective) {
                    $remainingAmount = $objective->year_objective - $totalAmountRealized;

                    $objective->update([
                        'amount_realized' => $totalAmountRealized,
                        'remaining_amount' => $remainingAmount,
                        'updated_by' => $user->id,
                    ]);
                }
            }

            $totalCapital = 0;

            $potentialCase->update([
                'client_id' => $request->input('client_id') ?? $potentialCase->client_id ,
                'case_name' => $request->input('case_name') ?? $potentialCase->case_name,
                'updated_by' => $user->id,
            ]);

            $potentialCase->branches()->detach();

            if ($request->has('branches') && $request->has('branch_ca')) {
                $branches = $request->input('branches');
                $branchCaValues = $request->input('branch_ca');

                foreach ($branches as $branchId) {
                    $branchCaValue = $branchCaValues[$branchId] ?? null;

                    if ($branchCaValue) {

                        $totalCapital += $branchCaValue;

                        $potentialCase->branches()->attach($branchId, [
                            'branch_ca' => $branchCaValue,
                        ]);
                    }
                }
            }

            $potentialCase->update(['case_capital' => $totalCapital]);

            $this->potencialCaseHisotryService->createHistoryRecord('updated', 'L\'affaire a été mise à jour', $potentialCase, null, null, $user->id);

            DB::commit();

            return ['status' => 'success', 'message' => 'L\'affaire a été mise à jour avec succès'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Potential case update failed: ' . $e->getMessage());

            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }



    public function deletePotencialCase($id)
    {
        $user = auth()->user();
        $potentialCase = null;

        if ($user->user_type == 'Super Responsable') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches'])->findOrFail($id);
        }

        if ($user->user_type == 'Responsable') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches'])
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->findOrFail($id);
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches'])
                ->where('created_by', $user->id)
                ->findOrFail($id);
        }

        if (!$potentialCase) {
            return ['status' => 'error', 'message' => 'You do not have permission to delete this case or the case does not exist.'];
        }

        try {
            $potentialCase->delete();

            return ['status' => 'success', 'message' => 'Potencial Case deleted successfully'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Error deleting potential case: ' . $e->getMessage()];
        }
    }

    public function detailsPotentialCase($id)
    {
        $user = auth()->user();
        $potentialCase = null;

        if ($user->user_type == 'Super Responsable') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches', 'caseHistories.user', 'appointments.creator', 'reports.creator', 'reports.appointment', 'reports.potential_case',])->findOrFail($id);
        }

        if ($user->user_type == 'Responsable') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches', 'caseHistories.user', 'appointments.creator', 'reports.creator', 'reports.appointment', 'reports.potential_case',])
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->findOrFail($id);
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches', 'caseHistories.user', 'appointments.creator', 'reports.creator', 'reports.appointment', 'reports.potential_case',])
                ->where('created_by', $user->id)
                ->findOrFail($id);
        }


        if (!$potentialCase) {
            abort(404, 'Potential Case not found');
        }


        $branches = Branche::all();
        $clients = Client::all();
        $cities = City::all();
        return [
            'potentialCase' => $potentialCase,
            'branches' => $branches,
            'clients' => $clients,
            'cities' => $cities,
        ];
    }


    public function createCommentPotentialCase($validated, $id)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches'])->findOrFail($id);

            PotencialCaseHisotry::create([
                'comment' => $validated['comment'],
                'action_type' => 'created',
                'action_date' => Carbon::now(),
                'potencial_case_id' => $potentialCase->id,
                'created_by' => $user->id,
            ]);

            DB::commit();
            return ['status' => 'success', 'message' => 'Le commentaire a été créé avec succès'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Potential case update failed: ' . $e->getMessage());

            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }
    public function updateStatusPotentialCase($validated, $id)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'branches'])->findOrFail($id);
            $statusTranslations = [
                'pending' => 'En attente',
                'completed' => 'Terminé',
                'processing' => 'En cours',
                'cancelled' => 'Annulé',
            ];

            $translatedStatus = isset($statusTranslations[$validated['case_status']])
                ? $statusTranslations[$validated['case_status']]
                : 'Non défini';

            // If the case status is being changed to 'completed'
            if ($validated['case_status'] == 'completed') {
                // Get the commercial_id from the potential case (assuming 'created_by' is the commercial_id)
                $commercialId = $potentialCase->created_by;
                $year = date('Y'); // Assuming the year is the current year

                // Calculate the total of 'branch_ca' for this commercial_id in the same year
                $totalAmountRealized = PotencialCase::where('created_by', $commercialId)  // Same commercial_id
                    ->whereYear('created_at', $year)  // Same year
                    ->with('branches')  // Ensure branches relationship is loaded
                    ->get()
                    ->flatMap(function ($case) {
                        // Collect all branch_ca values from the pivot table
                        return $case->branches->pluck('pivot.branch_ca');
                    })
                    ->sum();  // Sum all branch_ca values to get the total realized amount

                // Fetch the objective for the same commercial_id and year
                $objective = Objective::where('commercial_id', $commercialId)
                    ->where('year', $year)
                    ->first();

                // If the objective exists, update its 'amount_realized' and 'remaining_amount'
                if ($objective) {
                    $remainingAmount = $objective->year_objective - $totalAmountRealized;

                    // Update the objective with the calculated amounts
                    $objective->update([
                        'amount_realized' => $totalAmountRealized,
                        'remaining_amount' => $remainingAmount,
                        'updated_by' => $user->id,
                    ]);
                }
            }

            // Update the status of the potential case regardless of the status
            $potentialCase->update([
                'case_status' => $validated['case_status'],
                'updated_by' => $user->id,
            ]);

            // Log the status change in the history table
            PotencialCaseHisotry::create([
                'comment' => "Statut modifié à: $translatedStatus",
                'action_type' => 'status_changed',
                'action_date' => Carbon::now(),
                'potencial_case_id' => $potentialCase->id,
                'created_by' => $user->id,
            ]);

            DB::commit();
            return ['status' => 'success', 'message' => 'Statut a été mis à jour avec succès'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Potential case update failed: ' . $e->getMessage());

            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }




    // public function storeComment($validatedData, $id)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $user = Auth::user();
    //         $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])->findOrFail($id);
    //         $history = PotencialCaseHisotry::create([
    //             'comment' => $validatedData['comment'], 
    //             'action_type' => 'created',
    //             'action_date' => Carbon::now(),
    //             'potencial_case_id' => $potentialCase->id,
    //             'created_by' => $user->id,
    //         ]);
    //         $history->load('user');
    //         DB::commit();
    //         return $history;
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Comment creation failed: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }
}
