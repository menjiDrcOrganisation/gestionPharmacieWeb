<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacie extends Model
{
    //

    protected $primaryKey = 'id_pharmacie';
    protected $table = 'pharmacies';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable=[
        "nom",
        "adresse",
        "telephone",
        "indice",
        "id_gerant",
        "statut"
    ];

    public function medicaments()
{
    return $this->belongsToMany(
        Medicament::class,
        'pharmacie_medicament',
        'id_pharmacie',
        'id_medicament'
    );
}

public function gerant()
{
    return $this->belongsTo(gerant::class, 'id_gerant', 'id_gerant');
}
}
