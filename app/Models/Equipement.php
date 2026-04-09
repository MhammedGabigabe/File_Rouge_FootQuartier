<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Terrain;

class Equipement extends Model
{
    public function terrains() {
        return $this->belongsToMany(Terrain::class, 'equipement_terrain');
    }
}
