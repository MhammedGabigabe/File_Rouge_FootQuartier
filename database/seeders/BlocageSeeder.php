<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blocage;
use App\Models\User;
use App\Models\Terrain;

class BlocageSeeder extends Seeder
{
    public function run(): void
    {
        $mod1    = User::where('email', 'youssef@footquartier.ma')->first();
        $soufiane = User::where('email', 'soufiane@test.ma')->first();
        $terrain  = Terrain::where('nom_terrain', 'Atlas Sport 5')->first();
 
        Blocage::create([
            'moderateur_id' => $mod1->id,
            'joueur_id'     => $soufiane->id,
            'terrain_id'    => $terrain->id,
            'raison'        => 'Commentaires irrespectueux envers les autres joueurs',
        ]);
    }
}
