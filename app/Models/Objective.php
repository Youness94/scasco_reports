<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $fillable = [
        'year_objective',         
        'amount_realized',        
        'remaining_amount',        
        'year',                   
        'objective_status',        
        'commercial_id',           
        'created_by',              
        'updated_by',  
    ];

    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime', 
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function commercial()
    {
        return $this->belongsTo(User::class, 'commercial_id');
    }
}
