<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
use App\Models\User;
use App\Models\pharmacie;

class gerant extends Model
{
    // protected $table = 'gerants';          
    // protected $primaryKey = 'id_gerant';   
    // public $incrementing = true;
    // protected $keyType = 'int';

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pharmacies()
{
    return $this->hasMany(Pharmacie::class, 'id_gerant');
}

}
