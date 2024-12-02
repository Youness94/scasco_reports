<?php


namespace App\Services;

use App\Http\Requests\ClientRequest;
use App\Models\Branche;
use App\Models\City;
use App\Models\Client;
use App\Models\PotencialCase;
use App\Models\Service;
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
            return PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])->get();
        }

        if ($user->user_type == 'Responsable') {
            return PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->get();
        }
        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {

            return PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])
                ->where('created_by', $user->id)
                ->get();
        }

        return PotencialCase::none();
    }

    public function getAllClientsAndServices()
    {
        $services = Service::with('branches')->get();
        $clients = Client::all();
        $cities = City::all();
        return compact('clients', 'services','cities');
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
                'case_number' => $generated_number,
                'case_status' => 'pending',
                'client_id' => $request->input('client_id'),
                'created_by' => $user->id,
            ]);

            foreach ($request->services as $serviceId) {
                $service = Service::findOrFail($serviceId);

                $branchIds = $request->branches[$serviceId] ?? [];
                $potentialCase->services()->attach($serviceId, [
                    'branch_ids' => json_encode($branchIds),
                ]);
            }
            $this->potencialCaseHisotryService->createHistoryRecord(
                'created',
                'Potential case created',
                $potentialCase,
                null,
                null,
                $user->id
            );
            DB::commit();

            return ['status' => 'success', 'message' => 'Potential case created successfully'];
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
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])->findOrFail($id);
        }
   
        if ($user->user_type == 'Responsable') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->findOrFail($id);
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])
                ->where('created_by', $user->id)
                ->findOrFail($id);
        }
    
    
        if (!$potentialCase) {
            abort(404, 'Potential Case not found');
        }
    
        
        $services = Service::with('branches')->get();
        $clients = Client::all();
        $cities = City::all();
        return [
            'potentialCase' => $potentialCase,
            'services' => $services,
            'clients' => $clients,
            'cities' => $cities,
        ];
    }

    public function updatePotentialCase($request, $id)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])->findOrFail($id);

            // Update the potential case
            $potentialCase->update([
                'client_id' => $request->input('client_id'),
                'updated_by' => $user->id,
            ]);

            // detach old services and their associated branches
            $potentialCase->services()->detach();

            // attach new services with their corresponding branches
            foreach ($request->services as $serviceId) {
                $service = Service::with('branches')->findOrFail($serviceId);

                // selected branches for this service
                $branchIds = $request->branches[$serviceId] ?? [];

                // attach the service with its branches
                $potentialCase->services()->attach($serviceId, [
                    'branch_ids' => json_encode($branchIds),
                ]);
            }
            $this->potencialCaseHisotryService->createHistoryRecord('updated', 'Potential case updated', $potentialCase, null, null, $user->id);
            DB::commit();

            return ['status' => 'success', 'message' => 'Potential case updated successfully'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Potential case update failed: ' . $e->getMessage());

            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }


    public function getBranchesByService($serviceIds)
    {
        // Get services with branches for the selected services
        return Service::with('branches')->whereIn('id', $serviceIds)->get();
    }

    public function editBranchesByService($serviceId)
    {
        $service = Service::with('branches')->findOrFail($serviceId);
        return [
            'service_name' => $service->name,
            'branches' => $service->branches
        ];
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
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])->findOrFail($id);
        }

        if ($user->user_type == 'Responsable') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])
                ->whereIn('created_by', function ($query) use ($user) {
                    $query->select('id')
                        ->from('users')
                        ->where('responsible_id', $user->id)
                        ->whereIn('user_type', ['Admin', 'Commercial']);
                })
                ->findOrFail($id);
        }

        if ($user->user_type == 'Admin' || $user->user_type == 'Commercial') {
            $potentialCase = PotencialCase::with(['creator', 'updater', 'client', 'services.branches'])
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
}
