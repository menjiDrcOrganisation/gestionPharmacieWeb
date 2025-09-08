<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Dose extends Model
{
    //
    

    protected $primaryKey = 'id_dose';

    protected $fillable = [
        'quantite',
        'unite',
    ];
}
