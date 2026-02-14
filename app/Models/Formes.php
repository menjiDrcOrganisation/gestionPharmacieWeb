<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formes extends Model
{
    
        protected $primaryKey = 'id_forme';
    public $incrementing = true; 
    protected $keyType = 'int'; 
    protected $fillable=[
        "nom",
        "description"
    ];
}
