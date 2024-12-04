<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_first_name',
        'client_last_name',
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
    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime', 
    ];
    public function potentialCases()
    {
        return $this->hasMany(PotencialCase::class, 'client_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function client_infos()
    {
        return $this->hasMany(ClientInfo::class);
    }
}
