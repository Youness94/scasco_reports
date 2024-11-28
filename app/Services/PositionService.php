<?php

namespace App\Services;

use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PositionService
{
    public function getAllPositions()
    {
        return Position::with('creator', 'updater')->get();
    }

    public function createPosition(array $data)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $position = Position::create([
                'name' => $data['name'],
                'created_by' => $user->id,
            ]);

            DB::commit();
            return $position;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Position creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updatePosition($id, array $data)
    {
        $position = Position::findOrFail($id);
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $position->name = $data['name'];
            $position->updated_by = $user->id;
            $position->save();

            DB::commit();
            return $position;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Position update failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deletePosition($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();
        return $position;
    }

    public function getPosition($id)
    {
        return Position::with('creator', 'updater')->findOrFail($id);
    }
}
