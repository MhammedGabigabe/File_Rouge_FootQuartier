<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipement;

class EquipementSeeder extends Seeder
{
public function run(): void
    {
        $equipements = [
            ['nom' => 'Vestiaires',        'descr_equipement' => 'Vestiaires avec douches'],
            ['nom' => 'Éclairage',         'descr_equipement' => 'Éclairage nocturne LED'],
            ['nom' => 'Parking',           'descr_equipement' => 'Parking gratuit sur place'],
            ['nom' => 'Gazon synthétique', 'descr_equipement' => 'Gazon synthétique dernière génération'],
            ['nom' => 'Tribunes',          'descr_equipement' => 'Tribunes couvertes'],
            ['nom' => 'Buvette',           'descr_equipement' => 'Buvette et restauration'],
            ['nom' => 'WiFi',              'descr_equipement' => 'WiFi gratuit'],
        ];
 
        foreach ($equipements as $eq) {
            Equipement::firstOrCreate(['nom' => $eq['nom']], $eq);
        }
    }
}
