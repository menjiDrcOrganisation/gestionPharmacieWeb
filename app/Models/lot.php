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

    protected $fillable=["numero_lot",
    "prix_achat",
    "prix_unitaire",
    "date_expiration",
    "id_medicament",
    "id_fournisseur"
    ];

      
      public function ventes()
      {
          return $this->belongsToMany(Vente::class, 'lot_vente', 'id_lot', 'id_vente');
      }
}
