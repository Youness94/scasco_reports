<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotencialCaseHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'statut_precedent',
        'statut_nouveau',
        'change_date',
        'commentaire',
        'potencial_case_id',
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
