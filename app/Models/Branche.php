<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'service_id',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime', 
    ];

    public function potencialCases()
    {
        return $this->belongsToMany(PotencialCase::class, 'potential_case_branches')
        ->withPivot('branch_ca') 
        ->withTimestamps(); 
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
