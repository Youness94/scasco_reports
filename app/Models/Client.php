<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_address',
        'client_phone',
        'client_email',
        'raison_sociale',
        'RC',
        'ICE',
        'client_type',
        'created_by',
        'updated_by',
        'city_id',
    ];
}
