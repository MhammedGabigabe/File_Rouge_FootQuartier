<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;


class Avis extends Model
{
    protected $fillable = [ 
        'reservation_id', 
        'note', 
        'date_avis', 
        'commentaire'
    ];

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }
}
