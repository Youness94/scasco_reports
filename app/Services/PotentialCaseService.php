<?php


namespace App\Services;

use App\Http\Requests\ClientRequest;
use App\Models\Branche;
use App\Models\City;
use App\Models\Client;
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

            // Create a new PotentialCase
            $potentialCase = PotencialCase::create([
                'case_name' => $request->input('case_name'),
                'case_number' => $generated_number,
                'case_status' => 'pending',
                'client_id' => $request->input('client_id'),
                'created_by' => $user->id,
            ]);

            // Iterate over selected branches and store branch_ca values
            if ($request->has('branches') && $request->has('branch_ca')) {
                $branches = $request->input('branches'); // Selected branches
                $branchCaValues = $request->input('branch_ca'); // branch_ca values

                foreach ($branches as $branchId) {
                    // Ensure a branch_ca value exists for each selected branch
                    $branchCaValue = $branchCaValues[$branchId] ?? null;

                    if ($branchCaValue) {
                        // Store the branch and its associated branch_ca value in the pivot table
                        $potentialCase->branches()->attach($branchId, [
                            'branch_ca' => $branchCaValue, // The 'turnover' value
                        ]);
                    }
                }
            }

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
    public function getBranchesByService($serviceIds)
    {
        // Get services with branches for the selected services
        return Service::with('branches')->whereIn('id', $serviceIds)->get();
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

            // Update the potential case details
            $potentialCase->update([
                'client_id' => $request->input('client_id'),
                'case_name' => $request->input('case_name'),
                'updated_by' => $user->id,
            ]);

            $potentialCase->branches()->detach();

            if ($request->has('branches') && $request->has('branch_ca')) {
                $branches = $request->input('branches');
                $branchCaValues = $request->input('branch_ca');


                foreach ($branches as $branchId) {
                    $branchCaValue = $branchCaValues[$branchId] ?? null;

                    if ($branchCaValue) {
                        $potentialCase->branches()->attach($branchId, [
                            'branch_ca' => $branchCaValue, 
                        ]);
                    }
                }
            }
            // Create a history record for the update
            $this->potencialCaseHisotryService->createHistoryRecord('updated', 'L\'affaire a été mise à jour', $potentialCase, null, null, $user->id);

            DB::commit();

            return ['status' => 'success', 'message' => 'L\'affaire a été mise à jour avec succès'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Potential case update failed: ' . $e->getMessage());

            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }





    public function editBranchesByService($serviceId, $caseId)
    {
        // Fetch the service with branches
        $service = Service::with('branches')->findOrFail($serviceId);

        // Fetch the potential case associated with the given caseId and serviceId
        $potentialCase = PotencialCase::whereHas('services', function ($query) use ($serviceId) {
            $query->where('service_id', $serviceId);
        })->first();

        // Retrieve the branch data (amounts) associated with the service in this potential case
        $branchData = [];
        if ($potentialCase) {
            $branchData = json_decode($potentialCase->services->where('id', $serviceId)->first()->pivot->branch_data, true);
        }

        // Map the branch data along with the branches
        $branchesWithAmounts = $service->branches->map(function ($branch) use ($branchData) {
            $amount = null;
            foreach ($branchData as $data) {
                if ($data['branch_id'] == $branch->id) {
                    $amount = $data['amount']; // Retrieve the amount for this branch
                    break;
                }
            }
            return [
                'branch' => $branch,
                'amount' => $amount
            ];
        });

        // Return the branches with amounts and the service name
        return response()->json([
            'service_name' => $service->name,
            'branches' => $branchesWithAmounts
        ]);
    }

    public function updateBranchesForService($serviceId, $branchIds)
    {
        $service = Service::findOrFail($serviceId);

        foreach ($branchIds as $branchId) {
            $branch = Branche::find($branchId);
            if ($branch) {
                $branch->service_id = $serviceId;
                $branch->save();
            }
        }
    }

    public function removeBranchesFromService($serviceId)
    {
        $service = Service::findOrFail($serviceId);

        Branche::where('service_id', $serviceId)->update(['service_id' => null]);

        Branche::where('service_id', $serviceId)->delete();
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
            $potentialCase->update([
                'case_status' =>  $validated['case_status'],
                'updated_by' => $user->id,
            ]);

            PotencialCaseHisotry::create([
                'comment' => "Statut modifié à: $translatedStatus",
                'action_type' => 'status_changed',
                'action_date' => Carbon::now(),
                'potencial_case_id' => $potentialCase->id,
                'created_by' => $user->id,
            ]);

            DB::commit();
            return ['status' => 'success', 'message' => 'statu a été mise à jour avec succès'];
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
