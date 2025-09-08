<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vendeur extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'vendeurs';

    protected $primaryKey = 'id_vendeur';

    protected $fillable = [
       'id_utilisateur',
        'id_pharmacie',
        'id_vendeur'
        
    ];

    public $timestamps = true;

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    
}
