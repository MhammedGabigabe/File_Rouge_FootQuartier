<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Avis;
use App\Models\User;
use App\Models\Terrain;

class AvisSeeder extends Seeder
{
public function run(): void
    {
        $mehdi   = User::where('email', 'mehdi@test.ma')->first();
        $terrain = Terrain::where('nom_terrain', 'Gueliz Football')->first();
 
        Avis::create([
            'user_id'     => $mehdi->id,
            'terrain_id'  => $terrain->id,
            'note'        => 5,
            'commentaire' => 'Excellent terrain, très bien entretenu !',
        ]);
 
        $omar     = User::where('email', 'omar@test.ma')->first();
        $terrain1 = Terrain::where('nom_terrain', 'Atlas Sport 5')->first();
 
        Avis::create([
            'user_id'     => $omar->id,
            'terrain_id'  => $terrain1->id,
            'note'        => 4,
            'commentaire' => 'Bon terrain, éclairage parfait pour le soir.',
        ]);
    }
}
