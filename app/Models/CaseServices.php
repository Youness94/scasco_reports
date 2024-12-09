<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'potencial_case_id',
        'service_id',
        'branch_ids',
        // 'branch_amounts',
        'branch_data',
      
    ];
    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime', 
    ];
}
