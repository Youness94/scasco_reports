<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotentialCaseBranche extends Model
{
    use HasFactory;

    protected $table = 'potential_case_branches';
    protected $fillable = [
        'branch_ca',
        'potencial_case_id',
        'branch_id',
      
    ];
    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime', 
    ];
}
