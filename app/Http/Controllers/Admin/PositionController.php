<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PositionService;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    protected $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function get_all_positions()
    {
        $positions = $this->positionService->getAllPositions();
        return view('positions.positions_list', compact('positions'));
    }

    public function add_position()
    {
        $positions = $this->positionService->getAllPositions();
        return view('positions.add_position', compact('positions'));
    }

    public function store_position(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ], [
           'name.required' => 'Le nom est obligatoire.',
        ]);

        try {
            $this->positionService->createPosition($validatedData);
            return redirect('/positions')->with('success', 'Position created successfully');
        } catch (\Exception $e) {
            return redirect('/ajouter-position')->with('error', 'Position not created');
        }
    }

    public function edit_position($id)
    {
        $position = $this->positionService->getPosition($id);
        return view('positions.edit_position', compact('position'));
    }

    public function update_position(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes',
        ], [
           'name.sometimes' => 'Le nom est obligatoire.',
        ]);

        try {
            $this->positionService->updatePosition($id, $validatedData);
            return redirect('/positions')->with('success', 'Position updated successfully');
        } catch (\Exception $e) {
            return redirect('/edit-position/' . $id)->with('error', 'Position not updated');
        }
    }

    public function delete_position($id)
    {
        try {
            $this->positionService->deletePosition($id);
            return redirect('/positions')->with('success', 'Position deleted successfully');
        } catch (\Exception $e) {
            return redirect('/positions')->with('error', 'Position not deleted');
        }
    }
}