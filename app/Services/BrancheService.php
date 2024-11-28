<?php

namespace App\Services;

use App\Models\Branche;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrancheService
{
    public function getAllBranches()
    {
        return Branche::with('creator', 'updater', 'service')->get();
    }

    public function getAllServices()
    {
        return Service::all();
    }

    public function createBranche($data)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $branche = Branche::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'service_id' => $data['service_id'],
                'created_by' => $user->id,
            ]);

            DB::commit();
            return ['status' => 'success', 'message' => 'Branche created successfully'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Branche creation failed: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Branche not created'];
        }
    }

    public function getBrancheById($id)
    {
        return Branche::with('creator', 'updater', 'service')->findOrFail($id);
    }

    public function updateBranche($id, $data)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $branche = Branche::with('creator', 'updater', 'service')->findOrFail($id);
            $branche->name = $data['name'];
            $branche->description = $data['description'];
            $branche->service_id = $data['service_id'];
            $branche->updated_by = $user->id;
            $branche->save();

            DB::commit();
            return ['status' => 'success', 'message' => 'Branche updated successfully'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Branche update failed: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage() ?: 'DB Error'];
        }
    }

    public function deleteBranche($id)
    {
        $branche = Branche::with('creator', 'updater')->findOrFail($id);
        $branche->delete();
        return ['status' => 'success', 'message' => 'Branche deleted successfully'];
    }
}
