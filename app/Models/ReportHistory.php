<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_action',
        'commentaire',
        'appointment_id',
        'created_by',
        'updated_by',
      
    ];
}
