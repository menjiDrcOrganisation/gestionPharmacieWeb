<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vente extends Model
{
    //

    protected $primaryKey = 'id_vente';
    protected $table = 'ventes';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable=["date_vente",
    "montant_total",
    "nom_client",
    "id_pharmacie" 
    
    ];

    public function lots()
    {
        return $this->belongsToMany(lot::class, 'lot_vente', 'id_lot', 'id_vente');
    }
    public function pharmacie()
    {
        return $this->belongsTo(Pharmacie::class, 'id_pharmacie', 'id_pharmacie');
    }
}
