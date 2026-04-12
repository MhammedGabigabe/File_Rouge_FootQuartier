<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Terrain;
use App\Models\User;
use App\Models\Equipement;

class TerrainSeeder extends Seeder
{
    public function run(): void
    {
        $mod1 = User::where('email', 'youssef@footquartier.ma')->first();
        $mod2 = User::where('email', 'karim@footquartier.ma')->first();
 
        $terrains = [
            [
                'moderateur_id'   => $mod1->id,
                'nom_terrain'     => 'Atlas Sport 5',
                'localisation'    => 'Hay Salam, Marrakech',
                'latitude'        => 31.6340,
                'longitude'       => -7.9900,
                'prix'            => 200.00,
                'description_terr'=> 'Terrain 5v5 en gazon synthétique, éclairé',
                'capacite'        => 5,
                'statut'          => 'actif',
                'equipements'     => ['Vestiaires', 'Éclairage', 'Gazon synthétique'],
            ],
            [
                'moderateur_id'   => $mod1->id,
                'nom_terrain'     => 'Atlas Sport 7',
                'localisation'    => 'Hay Salam, Marrakech',
                'latitude'        => 31.6345,
                'longitude'       => -7.9905,
                'prix'            => 350.00,
                'description_terr'=> 'Terrain 7v7 avec parking et vestiaires',
                'capacite'        => 7,
                'statut'          => 'actif',
                'equipements'     => ['Vestiaires', 'Parking', 'Éclairage'],
            ],
            [
                'moderateur_id'   => $mod2->id,
                'nom_terrain'     => 'Gueliz Football',
                'localisation'    => 'Gueliz, Marrakech',
                'latitude'        => 31.6200,
                'longitude'       => -7.9750,
                'prix'            => 300.00,
                'description_terr'=> 'Terrain 5v5 en plein centre ville',
                'capacite'        => 5,
                'statut'          => 'actif',
                'equipements'     => ['Éclairage', 'Parking', 'Buvette'],
            ],
            [
                'moderateur_id'   => $mod2->id,
                'nom_terrain'     => 'Mellah Arena',
                'localisation'    => 'Mellah, Marrakech',
                'latitude'        => 31.6180,
                'longitude'       => -7.9870,
                'prix'            => 450.00,
                'description_terr'=> 'Grand terrain 11v11 avec tribunes',
                'capacite'        => 11,
                'statut'          => 'actif',
                'equipements'     => ['Vestiaires', 'Tribunes', 'Parking', 'Buvette'],
            ],
        ];
 
        foreach ($terrains as $data) {
            $equipementsNoms = $data['equipements'];
            unset($data['equipements']);
 
            $terrain = Terrain::create($data);
 
            $ids = Equipement::whereIn('nom', $equipementsNoms)->pluck('id');
            $terrain->equipements()->attach($ids);
        }
    }
}
