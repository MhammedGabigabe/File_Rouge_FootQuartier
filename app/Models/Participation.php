<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Transaction;

class Participation extends Model
{
    protected $fillable = [
        'annonce_id', 
        'user_id',
        'points_payes', 
        'statut',
    ];

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }

    public function joueur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction()
    {
        return $this->morphOne(Transaction::class, 'transactionnable');
    }

    public function peutSeRetirer(): bool
    {
        $dateDebut = $this->annonce->reservation->date_debut;
        return $this->statut === 'confirmee'
            && Carbon::now()->diffInHours($dateDebut, false) > 4;
    }
}
