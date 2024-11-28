<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PositionService;
use Illuminate\Http\Request;

class PositionApiController extends Controller
{
    protected $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function get_all_positions()
    {
        $positions = $this->positionService->getAllPositions();
        return response()->json($positions);
    }

    public function add_position()
    {
        $positions = $this->positionService->getAllPositions();
        return response()->json($positions);
    }

    public function store_position(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Veuillez entrer le nom du poste.',
        ]);

        try {
            $this->positionService->createPosition($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Position created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Position not created: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function edit_position($id)
    {
        $position = $this->positionService->getPosition($id);

        if ($position) {
            return response()->json($position);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Position not found',
        ], 404);
    }

    public function update_position(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes',
        ], [
            'name.sometimes' => 'Veuillez entrer le nom du poste.',
        ]);

        try {
            $this->positionService->updatePosition($id, $validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Position updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() ?: 'DB Error',
            ], 400);
        }
    }

    public function delete_position($id)
    {
        try {
            $this->positionService->deletePosition($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Position deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() ?: 'DB Error',
            ], 400);
        }
    }
}
