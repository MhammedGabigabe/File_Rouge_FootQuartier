<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Notification;


class Paiement extends Model
{
    protected $fillable = [
        'reservation_id', 
        'date_paiement', 
        'montant', 
        'statut'
    ];

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }

    public function notifications() {
        return $this->morphMany(Notification::class, 'source');
    }
}
