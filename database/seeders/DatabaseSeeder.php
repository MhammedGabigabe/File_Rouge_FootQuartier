<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            EquipementSeeder::class,
            TerrainSeeder::class,
            ReservationSeeder::class,
            AnnonceSeeder::class,
            ParticipationSeeder::class,
            AvisSeeder::class,
            BlocageSeeder::class,
        ]);
    }
}
