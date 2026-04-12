<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Terrain;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $mehdi   = User::where('email', 'mehdi@test.ma')->first();
        $anas    = User::where('email', 'anas@test.ma')->first();
        $terrain1 = Terrain::where('nom_terrain', 'Atlas Sport 5')->first();
        $terrain2 = Terrain::where('nom_terrain', 'Gueliz Football')->first();
 
        $reservations = [
            [
                'user_id'          => $mehdi->id,
                'terrain_id'       => $terrain1->id,
                'date_debut'       => Carbon::now()->addDays(2)->setTime(18, 0),
                'date_fin'         => Carbon::now()->addDays(2)->setTime(19, 0),
                'montant'          => 200.00,
                'stripe_payment_id'=> 'pi_test_mehdi_1',
                'statut'           => 'confirmee',
                'date_res'         => Carbon::now(),
                'rappel_envoye'    => false,
            ],
            [
                'user_id'          => $anas->id,
                'terrain_id'       => $terrain2->id,
                'date_debut'       => Carbon::now()->addDays(3)->setTime(20, 0),
                'date_fin'         => Carbon::now()->addDays(3)->setTime(21, 0),
                'montant'          => 300.00,
                'stripe_payment_id'=> 'pi_test_anas_1',
                'statut'           => 'confirmee',
                'date_res'         => Carbon::now(),
                'rappel_envoye'    => false,
            ],
            [
                // Réservation passée pour tester les avis
                'user_id'          => $mehdi->id,
                'terrain_id'       => $terrain2->id,
                'date_debut'       => Carbon::now()->subDays(5)->setTime(18, 0),
                'date_fin'         => Carbon::now()->subDays(5)->setTime(19, 0),
                'montant'          => 300.00,
                'stripe_payment_id'=> 'pi_test_mehdi_2',
                'statut'           => 'confirmee',
                'date_res'         => Carbon::now()->subDays(5),
                'rappel_envoye'    => true,
            ],
        ];
 
        foreach ($reservations as $data) {
            $reservation = Reservation::create($data);
 
            // Créer la transaction liée à chaque réservation
            Transaction::create([
                'user_id'                  => $data['user_id'],
                'type'                     => 'paiement_reservation',
                'montant'                  => $data['montant'],
                'points'                   => 0,
                'reference'                => $data['stripe_payment_id'],
                'statut'                   => 'reussi',
                'transactionnable_id'      => $reservation->id,
                'transactionnable_type'    => Reservation::class,
            ]);
        }
    }
}
