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
}
