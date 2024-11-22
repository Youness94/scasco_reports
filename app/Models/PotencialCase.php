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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
