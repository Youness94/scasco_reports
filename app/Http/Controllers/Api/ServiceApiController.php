<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ServiceService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class ServiceApiController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function get_all_services()
    {
        $services = $this->serviceService->getAllServices();
        return response()->json($services);
    }

    public function store_service(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ], [
            'name.required' => 'Veuillez entrer le nom du poste.',
        ]);

        try {
            $this->serviceService->createService($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Service created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function edit_service($id)
    {
        $service = Service::with('creator', 'updater')->find($id);
        if ($service) {
            return response()->json($service);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Service not found',
        ], 404);
    }

    public function update_service(Request $request, $id)
    {
        $service = Service::with('creator', 'updater')->findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes',
            'description' => 'sometimes',
        ], [
            'name.sometimes' => 'Veuillez entrer le nom du poste.',
        ]);

        try {
            $this->serviceService->updateService($service, $validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Service updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function delete_service($id)
    {
        try {
            $service = Service::with('creator', 'updater', 'branches')->findOrFail($id);
            $this->serviceService->deleteService($service);
            return response()->json([
                'status' => 'success',
                'message' => 'Service deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Service not deleted: ' . $e->getMessage(),
            ], 400);
        }
    }
}
