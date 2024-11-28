<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceService
{
    public function getAllServices()
    {
        return Service::with('creator', 'updater')->get();
    }

    public function createService(array $data)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $service = Service::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'created_by' => $user->id,
            ]);
            DB::commit();
            return $service;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Service creation failed: ' . $e->getMessage());
            throw new \Exception('Service not created');
        }
    }

    public function updateService(Service $service, array $data)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $service->name = $data['name'] ?? $service->name;
            $service->description = $data['description'] ?? $service->description;
            $service->updated_by = $user->id;
            $service->save();
            DB::commit();
            return $service;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Service update failed: ' . $e->getMessage());
            throw new \Exception('Service not updated');
        }
    }

    public function deleteService(Service $service)
    {
        $service->delete();
    }
}
