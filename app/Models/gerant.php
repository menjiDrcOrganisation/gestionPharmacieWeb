<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
use App\Models\User;

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
}
