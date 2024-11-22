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
        'created_by',
        'updated_by',
      
    ];
}
