<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fournissseur extends Model
{
    protected $primaryKey = 'id_fournisseur';
    protected $table = 'fournisseurs';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        "nom",
        "adresse",
        "telephone",
        "email"
    ];

    public function lots()
    {
        return $this->hasMany(Lot::class, 'id_fournisseur', 'id_fournisseur');
    }
}
