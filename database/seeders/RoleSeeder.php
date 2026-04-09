<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['titre' => 'Admin'],
            ['titre' => 'Moderateur'],
            ['titre' => 'Membre'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['titre' => $role['titre']], $role);
        }
    }
}
