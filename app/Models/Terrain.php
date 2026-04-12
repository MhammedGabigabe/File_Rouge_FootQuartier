<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Equipement;
use App\Models\User;
use App\Models\Avis;
use App\Models\Blocage;

class Terrain extends Model
{
    use HasFactory;
    protected $fillable = [
        'moderateur_id', 
        'nom_terrain', 
        'localisation',
        'latitude', 
        'longitude', 
        'prix',
        'description_terr', 
        'photo', 
        'capacite', 
        'statut',
    ];

    public function moderateur() {
       return $this->belongsTo(User::class, 'moderateur_id');
    }

    public function equipements() {
       return $this->belongsToMany(Equipement::class, 'equipement_terrain');
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function blocages()
    {
        return $this->hasMany(Blocage::class);
    }

    public function scopeProcheDe($query, $lat, $lng, $rayon = 10)
    {
        $distance = "(6371 * acos(
            cos(radians($lat)) * cos(radians(latitude)) *
            cos(radians(longitude) - radians($lng)) +
            sin(radians($lat)) * sin(radians(latitude))
        ))";

        return $query
            ->selectRaw("*, $distance as distance")
            ->having('distance', '<', $rayon)
            ->orderBy('distance', 'asc');
    }
}
