<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gerant extends Model
{
   protected $primaryKey = 'id_gerant';
    protected $table = 'gerants';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable=[
        "id_utilisateur",
        "id_gerant"
    ];
}
