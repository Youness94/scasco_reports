<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function get_all_services()
    {
        $services = $this->serviceService->getAllServices();
        return view('services.services_list', compact('services'));
    }

    public function add_service()
    {
        $services = $this->serviceService->getAllServices();
        return view('services.add_service', compact('services'));
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
            return redirect('/services')->with('success', 'Service created successfully');
        } catch (\Exception $e) {
            return redirect('/ajouter-service')->with('error', $e->getMessage());
        }
    }

    public function edit_service($id)
    {
        $service = Service::with('creator', 'updater')->findOrFail($id);
        return view('services.edit_service', compact('service'));
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
            return redirect('/services')->with('success', 'Service updated successfully');
        } catch (\Exception $e) {
            return redirect('/edit-service/'.$id)->with('error', $e->getMessage());
        }
    }

    public function delete_service($id)
    {
        $service = Service::with('creator', 'updater', 'branches')->findOrFail($id);
        $this->serviceService->deleteService($service);
        return redirect('/services')->with('success', 'Service deleted successfully');
    }
}
