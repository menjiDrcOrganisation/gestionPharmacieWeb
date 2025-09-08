<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
use App\Models\Formes;
use App\Models\Dose;

class Medicament extends Model
{
    //
    protected $fillable = [
        'nom',
        'description',
        'id_forme',
        'id_dose',
    ];

    public function forme()
    {
        return $this->belongsTo(Formes::class, 'id_forme');
    }

    public function dose()
    {
        return $this->belongsTo(Dose::class, 'id_dose');
    }
}
