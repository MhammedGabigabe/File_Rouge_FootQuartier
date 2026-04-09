<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('titre', 'Admin')->first();
        $modRole = Role::where('titre', 'Moderateur')->first();
        $membreRole = Role::where('titre', 'Membre')->first();

        $admin = User::create([
            'nom' => 'Admin FootQuartier',
            'email' => 'admin@foot.com',
            'password' => 'password',
            'estApprouve' => true,
            'estActif' => true,
        ]);
        $admin->roles()->attach($adminRole);

        $mod = User::create([
            'nom' => 'Moderateur Sport',
            'email' => 'mod@foot.com',
            'password' => 'password',
            'estApprouve' => true,
            'estActif' => true,
        ]);
        $mod->roles()->attach($modRole);

        $membre = User::create([
            'nom' => 'Jean Capitaine',
            'email' => 'jean@foot.com',
            'password' => 'password',
            'estApprouve' => false, 
            'estActif' => true,
        ]);
        $membre->roles()->attach($membreRole);

        User::factory(10)->create()->each(function ($user) use ($membreRole) {
            $user->roles()->attach($membreRole);
        });
    }
}
