<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    //
    protected $primaryKey = 'id_medicament';
    protected $table = 'medicaments';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable =[
        "nom",
        "description",
        "id_forme",
        "id_dose"
    ];

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacie::class, 'pharmacie_medicament', 'id_medicament', 'id_pharmacie');
    }
}
