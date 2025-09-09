<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\gerant;


class Pharmacie extends Model
{
    
    protected $fillable = [
        'nom',
        'adresse',
        'telephone',
        'indice',
        'id_gerant',
        'statut',
    ];

    public function gerant()
    {
        return $this->belongsTo(gerant::class, 'id_gerant');
    }
}
