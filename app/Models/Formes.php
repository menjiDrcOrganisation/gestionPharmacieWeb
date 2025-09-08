<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
class Formes extends Model
{
    //
    

    protected $primaryKey = 'id_forme';

    protected $fillable = [
        'nom',
        'description',
    ];
}
