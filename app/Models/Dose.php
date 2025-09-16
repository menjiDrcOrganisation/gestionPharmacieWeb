<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dose extends Model
{

    protected $primaryKey = 'id_dose';
    public $incrementing = true; 
    protected $keyType = 'int'; 
    protected $fillable=[
        "quantite",
        "unite"
    ];
}
