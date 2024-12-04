<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_report',
        'contenu',
        'potencial_case_id',
        'appointment_id',
        'created_by',
        'updated_by',
      
    ];
    protected $casts = [
        'date_report' => 'datetime',
        'created_at' => 'datetime', 
        'updated_at' => 'datetime', 
    ];
    public function caseHistories()
    {
        return $this->hasMany(PotencialCaseHisotry::class, 'report_id');
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

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
