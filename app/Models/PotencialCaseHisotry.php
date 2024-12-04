<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotencialCaseHisotry extends Model
{
    use HasFactory;
    protected $table = 'potencial_case_histories';

    protected $fillable = [
        'comment', 'action_type', 'action_date', 'potencial_case_id', 'appointment_id', 'report_id', 'created_by'
    ];
    protected $casts = [
        'action_date' => 'datetime',
        'created_at' => 'datetime', 
        'updated_at' => 'datetime', 
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function potencialCase()
    {
        return $this->belongsTo(PotencialCase::class, 'potencial_case_id');
    }
}
