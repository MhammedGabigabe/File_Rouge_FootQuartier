<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Terrain;

class Blocage extends Model
{
    protected $fillable = [
        'moderateur_id', 
        'joueur_id',
        'terrain_id', 
        'raison',
    ];

    public function moderateur()
    {
        return $this->belongsTo(User::class, 'moderateur_id');
    }

    public function joueur()
    {
        return $this->belongsTo(User::class, 'joueur_id');
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }
}
