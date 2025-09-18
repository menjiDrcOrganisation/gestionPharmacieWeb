<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    
    protected $primaryKey = 'id_admin';
    public $incrementing = true; 
    protected $keyType = 'int'; 
    protected $fillable=[
        "id_utilisateur"
        
    ];

      public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur', 'id');
    }
}
