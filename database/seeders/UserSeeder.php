<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('titre', 'Admin')->first();
        $modRole = Role::where('titre', 'Moderateur')->first();
        $joueurRole = Role::where('titre', 'joueur')->first();

        $admin = User::create([
            'nom'          => 'Admin Foot Quartier',
            'email'        => 'admin@footquartier.ma',
            'password'     => Hash::make('password'),
            'pointsCompte' => 0,
            'estActif'     => true,
            'estApprouve'  => true,
            'latitude'     => 31.6295,
            'longitude'    => -7.9811,
        ]);
        $admin->roles()->attach($adminRole);

        $mod1 = User::create([
            'nom'          => 'Youssef Alami',
            'email'        => 'youssef@footquartier.ma',
            'password'     => Hash::make('password'),
            'pointsCompte' => 0,
            'estActif'     => true,
            'estApprouve'  => true,
            'stripe_id'    => 'acct_test_moderateur1',
            'latitude'     => 31.6340,
            'longitude'    => -7.9900,
        ]);
        $mod1->roles()->attach([$modRole->id, $joueurRole->id]);
 
        $mod2 = User::create([
            'nom'          => 'Karim Bennani',
            'email'        => 'karim@footquartier.ma',
            'password'     => Hash::make('password'),
            'pointsCompte' => 0,
            'estActif'     => true,
            'estApprouve'  => true,
            'stripe_id'    => 'acct_test_moderateur2',
            'latitude'     => 31.6200,
            'longitude'    => -7.9750,
        ]);
        $mod2->roles()->attach([$modRole->id, $joueurRole->id]);

        $joueurs = [
            ['nom' => 'Mehdi Tazi',     'email' => 'mehdi@test.ma',   'lat' => 31.6310, 'lng' => -7.9820, 'points' => 500],
            ['nom' => 'Anas Chraibi',   'email' => 'anas@test.ma',    'lat' => 31.6280, 'lng' => -7.9780, 'points' => 300],
            ['nom' => 'Omar Idrissi',   'email' => 'omar@test.ma',    'lat' => 31.6350, 'lng' => -7.9850, 'points' => 200],
            ['nom' => 'Hamza Filali',   'email' => 'hamza@test.ma',   'lat' => 31.6290, 'lng' => -7.9800, 'points' => 150],
            ['nom' => 'Soufiane Amri',  'email' => 'soufiane@test.ma','lat' => 31.6320, 'lng' => -7.9830, 'points' => 400],
        ];
 
        foreach ($joueurs as $data) {
            $joueur = User::create([
                'nom'          => $data['nom'],
                'email'        => $data['email'],
                'password'     => Hash::make('password'),
                'pointsCompte' => $data['points'],
                'estActif'     => true,
                'estApprouve'  => false,
                'latitude'     => $data['lat'],
                'longitude'    => $data['lng'],
            ]);
            $joueur->roles()->attach($joueurRole);
        }
    }
}
