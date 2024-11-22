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
            'name.required' => 'Veuillez entrer votre prénom.',
           
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
}
