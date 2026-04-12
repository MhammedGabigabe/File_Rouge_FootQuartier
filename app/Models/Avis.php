<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Terrain;
use App\Models\Reservation;
use App\Models\Participation;


class Avis extends Model
{
    protected $fillable = [ 
        'user_id', 
        'terrain_id',
        'note', 
        'commentaire',
    ];

    public function joueur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }

    public static function aDejaJoue(int $userId, int $terrainId)
    {
        $aReserve = Reservation::where('user_id', $userId)
            ->where('terrain_id', $terrainId)
            ->where('statut', 'confirmee')
            ->exists();

        $aParticipe = Participation::where('user_id', $userId)
            ->where('statut', 'confirmee')
            ->whereHas('annonce.reservation', function ($q) use ($terrainId) {
                $q->where('terrain_id', $terrainId)
                  ->where('statut', 'confirmee');
            })->exists();
 
        if ($aReserve || $aParticipe) {
            return true;
        }

        return false;
    }
}
