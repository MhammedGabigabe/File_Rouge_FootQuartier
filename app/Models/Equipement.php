<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Terrain;

class Equipement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'descr_equipement',
    ];

    public function terrains() {
        return $this->belongsToMany(Terrain::class, 'equipement_terrain');
    }
}
