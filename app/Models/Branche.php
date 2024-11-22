<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'service_id',
        'created_by',
        'updated_by',
    ];
}
