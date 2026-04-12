<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Participation;

class Annonce extends Model
{
    protected $fillable = [
        'reservation_id', 
        'user_id',
        'places_dispo', 
        'places_total', 
        'statut',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function organisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function estTropTard()
    {
        return Carbon::now()->diffInHours(
            $this->reservation->date_debut, false
        ) <= 2;
    }
 
    public function peutRejoindre()
    {
        return $this->statut === 'ouverte'
            && $this->places_dispo > 0
            && !$this->estTropTard();
    }
}
