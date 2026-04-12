<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Terrain;
use App\Models\Annonce;
use App\Models\Transaction;
use Carbon\Carbon;


class Reservation extends Model
{
    protected $fillable = [
        'user_id', 
        'terrain_id',
        'date_debut', 
        'date_fin',
        'montant', 
        'stripe_payment_id',
        'statut', 
        'date_res', 
        'rappel_envoye',
    ];

    protected $casts = [
        'date_debut'    => 'datetime',
        'date_fin'      => 'datetime',
        'date_res'      => 'datetime',
        'rappel_envoye' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }

    public function annonce()
    {
        return $this->hasOne(Annonce::class);
    }

    public function transaction()
    {
        return $this->morphOne(Transaction::class, 'transactionnable');
    }

    public function peutPublierAnnonce(): bool
    {
        return $this->statut === 'confirmee'
            && $this->annonce === null
            && Carbon::now()->diffInHours($this->date_debut, false) > 4;
    }

    public function scopeARappeler($query)
    {
        return $query->where('statut', 'confirmee')
            ->where('rappel_envoye', false)
            ->where('date_debut', '<=', Carbon::now()->addHours(2));
    }
}
