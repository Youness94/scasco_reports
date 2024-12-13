<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotencialCase extends Model
{
    use HasFactory;
    protected $fillable = [
        'case_number',
        'case_status',
        'client_id',
        'created_by',
        'updated_by',
        'case_capital',
        'case_name',

    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function branches()
    {
        return $this->belongsToMany(Branche::class, 'potential_case_branches')
            ->withPivot('branch_ca')
            ->withTimestamps();
    }

    public function caseHistories()
    {
        return $this->hasMany(PotencialCaseHisotry::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'potencial_case_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'potencial_case_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }


    public function getBranchNamesAttribute()
    {
        $branchNames = [];
        foreach ($this->services as $service) {
            $branchIds = json_decode($service->pivot->branch_ids ?? '[]', true);
            foreach ($branchIds as $branchId) {
                $branch = Branche::find($branchId);
                if ($branch) {
                    $branchNames[] = $branch->name;
                }
            }
        }
        return implode(', ', $branchNames);
    }
}
