<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_appointment',
        'place',
        'statuts',
        'potencial_case_id',
        'created_by',
        'updated_by',
        'client_id',
    ];
    protected $casts = [
        'date_appointment' => 'datetime',
        'created_at' => 'datetime', 
        'updated_at' => 'datetime', 
    ];
    public function caseHistories()
    {
        return $this->hasMany(PotencialCaseHisotry::class, 'appointment_id');
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function potential_case()
    {
        return $this->belongsTo(PotencialCase::class, 'potencial_case_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function reports()
    {
        return $this->belongsTo(Report::class,);
    }
}
