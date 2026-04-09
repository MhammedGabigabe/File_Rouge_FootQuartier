<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Terrain;
use App\Models\Avis;
use App\Models\Paiement;
use App\Models\Notification;


class Reservation extends Model
{
    protected $fillable = [
        'member_id', 
        'terrain_id', 
        'heure_debut', 
        'heure_fin', 
        'date_res', 
        'statut'
    ];

    public function member() {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }

    public function avis()
    {
        return $this->hasOne(Avis::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    public function notifications() {
        return $this->morphMany(Notification::class, 'source');
    }
}
