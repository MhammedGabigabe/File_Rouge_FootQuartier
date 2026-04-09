<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Terrain;
use App\Models\Reservation;
use App\Models\Paiement;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $membre = User::whereHas('roles', function($q) {
            $q->where('titre', 'Membre');
        })->first();

        $terrain = Terrain::first();

        if ($membre && $terrain) {
            $dateRes = Carbon::tomorrow();

            $reservation = Reservation::create([
                'member_id'   => $membre->id,
                'terrain_id'  => $terrain->id,
                'heure_debut' => $dateRes->copy()->setTime(18, 0), 
                'heure_fin'   => $dateRes->copy()->setTime(19, 0), 
                'date_res'    => $dateRes->startOfDay(),
                'statut'      => 'confirmee',
            ]);

            $paiement = $reservation->paiement()->create([
                'date_paiement' => now(),
                'montant'       => $terrain->prix,
                'statut'        => 'paye',
            ]);

            $reservation->notifications()->create([
                'user_id' => $membre->id,
                'message' => "Confirmation : Vous avez réservé le terrain {$terrain->nom_terrain} pour demain à 18h.",
            ]);

            $paiement->notifications()->create([
                'user_id' => $membre->id,
                'message' => "Paiement reçu : Le montant de {$paiement->montant} a été débité avec succès.",
            ]);
        }
    }
}
