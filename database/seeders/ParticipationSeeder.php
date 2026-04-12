<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Participation;
use App\Models\Transaction;
use App\Models\Annonce;
use App\Models\User;

class ParticipationSeeder extends Seeder
{
    public function run(): void
    {
        $omar    = User::where('email', 'omar@test.ma')->first();
        $hamza   = User::where('email', 'hamza@test.ma')->first();
        $annonce = Annonce::first();
 
        $participants = [
            ['user' => $omar,  'points' => 50],
            ['user' => $hamza, 'points' => 50],
        ];
 
        foreach ($participants as $data) {
            $participation = Participation::create([
                'annonce_id'  => $annonce->id,
                'user_id'     => $data['user']->id,
                'points_payes'=> $data['points'],
                'statut'      => 'confirmee',
            ]);
 
            $data['user']->decrement('pointsCompte', $data['points']);

            $annonce->organisateur->increment('pointsCompte', $data['points']);
 
            $annonce->decrement('places_dispo');
 
            Transaction::create([
                'user_id'               => $data['user']->id,
                'type'                  => 'transfert_points',
                'montant'               => 0,
                'points'                => $data['points'],
                'reference'             => 'PART-' . $participation->id,
                'statut'                => 'reussi',
                'transactionnable_id'   => $participation->id,
                'transactionnable_type' => Participation::class,
            ]);
        }
    }
}
