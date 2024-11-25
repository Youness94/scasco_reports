<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PositionController extends Controller
{
    public function get_all_positions()
    {

        $positions = Position::with('creator', 'updater')->get();

        return view('positions.positions_list', compact('positions'));
    }

    public function add_position()
    {

        $positions = Position::with('creator', 'updater')->get();

        return view('positions.add_position', compact('positions'));
    }


    public function store_position(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',


        ], [
            'name.required' => 'Veuillez entrer le nom du poste.',

        ]);
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $position = Position::create([
                'name' => $request->input('name'),
                'created_by' => $user->id,
            ]);

            DB::commit();
            return redirect('/positions')->with('success', 'Position created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return [
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ];
        }
    }

    public function edit_position($id)
    {

        $position = Position::with('creator', 'updater')->findOrFail($id);

        return view('positions.edit_position', compact('position'));
    }

    public function update_position(Request $request, $id)
    {
        $position = Position::with('creator', 'updater')->findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'sometimes',


        ], [
            'name.sometimes' => 'Veuillez entrer le nom du poste.',

        ]);

        DB::beginTransaction();
        try {

            $user = Auth::user();
            $position->name = $request->input('name');
            $position->updated_by = $user->id;
            $position->save();

            DB::commit();
            return redirect('/positions')->with('success', 'Position updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotes creation failed: ' . $e->getMessage());
            return [
                'status' => 'Error',
                'message' => $e->getMessage() ?: 'DB Error',
            ];
        }
    }

    public function delete_position($id){
        $position = Position::with('creator', 'updater')->findOrFail($id);
        $position->delete();
        return redirect('/positions')->with('success', 'Position deleted successfully');
    }
}
  