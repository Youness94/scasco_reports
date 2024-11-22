<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotencialCase extends Model
{
    use HasFactory;
    protected $fillable = [
        'case_number',
        'case_status',
        'service_id',
        'client_id',
        'created_by',
        'updated_by',
      
    ];
}
