<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'name',
        'created_by',
        'updated_by',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function branches(){
        return $this->hasMany(Branche::class);
    }
    // public function potencialCases()
    // {
    //     return $this->belongsToMany(PotencialCase::class)->withPivot('branch_ids');
    // }
    public function potencialCases()
    {
        return $this->belongsToMany(PotencialCase::class, 'potencial_case_service')
        ->withPivot('branch_data')  // Ensure this is included to access 'branch_data'
        ->withTimestamps(); 
    }
}
