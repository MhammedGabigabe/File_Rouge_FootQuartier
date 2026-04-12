<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Annonce;
use App\Models\Reservation;
use App\Models\User;

class AnnonceSeeder extends Seeder
{
    public function run(): void
    {
        $reservation = Reservation::where('stripe_payment_id', 'pi_test_mehdi_1')
            ->first();
 
        Annonce::create([
            'reservation_id' => $reservation->id,
            'user_id'        => $reservation->user_id,
            'places_dispo'   => 4,
            'places_total'   => 4,
            'statut'         => 'ouverte',
        ]);
 
        $reservation2 = Reservation::where('stripe_payment_id', 'pi_test_anas_1')
            ->first();
 
        Annonce::create([
            'reservation_id' => $reservation2->id,
            'user_id'        => $reservation2->user_id,
            'places_dispo'   => 6,
            'places_total'   => 6,
            'statut'         => 'ouverte',
        ]);
    }
}
