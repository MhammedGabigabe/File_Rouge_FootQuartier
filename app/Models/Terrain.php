<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Equipement;
use App\Models\User;

class Terrain extends Model
{
    use HasFactory;
    protected $fillable = [
        'moderateur_id',
        'nom_terrain', 
        'localisation', 
        'prix', 
        'description_terr', 
        'photo', 
        'capacite',
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
}
