<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gerant extends Model
{
    protected $primaryKey = 'id_gerant';
    protected $table = 'gerants';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        "id_utilisateur",
        "id_gerant"
    ];
    public function pharmacies()
    {
        return $this->hasMany(Pharmacie::class, 'id_gerant', 'id_gerant');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur', 'id');
    }
}
