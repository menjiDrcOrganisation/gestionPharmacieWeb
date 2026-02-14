<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lot extends Model
{
    //
    protected $primaryKey = 'id_lot';
    protected $table = 'lots';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        "date_expiration",
        "quantite",
        "prix_achat",
        "prix_unitaire",
        "numero_lot",
        "id_pharmacie",
        "id_medicament"
    ];

     
    public function ventes()
    {
        return $this->belongsToMany(Vente::class, 'lot_vente', 'id_lot', 'id_vente');
    }

    public function medicament()
    {
        return $this->belongsTo(Medicament::class, 'id_medicament', 'id_medicament');
    }


    public function pharmacie()
    {
        return $this->belongsTo(Pharmacie::class, 'id_pharmacie', 'id_pharmacie');
    }
}
