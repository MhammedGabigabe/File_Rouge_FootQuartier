<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipement;
use App\Models\Terrain;
use App\Models\User;

class TerrainSeeder extends Seeder
{

    public function run(): void
    {
        $equipem1 = Equipement::create(['nom' => 'Douches', 'descr_equipement' => 'Douches chaudes disponibles']);
        $equipem2 = Equipement::create(['nom' => 'Éclairage', 'descr_equipement' => 'Projecteurs LED pour matchs nocturnes']);
        $equipem3 = Equipement::create(['nom' => 'Parking', 'descr_equipement' => 'Parking sécurisé gratuit']);
        $equipem4 = Equipement::create(['nom' => 'Buvette', 'descr_equipement' => 'Vente de boissons et snacks']);

        $mod = User::whereHas('roles', function($q) {
            $q->where('titre', 'Moderateur');
        })->first();

        $terrain1 = Terrain::create([
            'moderateur_id'    => $mod->id,
            'nom_terrain' => 'City Stade Central',
            'localisation' => 'Centre Ville, Secteur A',
            'prix' => 45.00,
            'description_terr' => 'Terrain synthétique de haute qualité.',
            'photo' => 'stade_central.jpg',
            'capacite' => 10,
        ]);

        $terrain1->equipements()->attach([$equipem1->id, $equipem2->id, $equipem3->id]);


        $mod2 = User::whereHas('roles', function($q) {
            $q->where('titre', 'Moderateur');
            })->skip(1)->first();
        $terrain2 = Terrain::create([
            'moderateur_id'    => $mod2->id,
            'nom_terrain' => 'Five Arena',
            'localisation' => 'Zone Industrielle Nord',
            'prix' => 60.00,
            'description_terr' => 'Terrain indoor climatisé.',
            'photo' => 'five_arena.jpg',
            'capacite' => 12,
        ]);
        $terrain2->equipements()->attach([$equipem2->id, $equipem4->id]);
    }
}
