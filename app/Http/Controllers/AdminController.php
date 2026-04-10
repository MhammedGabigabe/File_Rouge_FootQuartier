<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Terrain;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('titre', 'Admin');
        })->with('roles')->paginate(4);

        $membersCount = User::whereHas('roles', function ($q) {
            $q->where('titre', 'Membre');
        })
        ->whereDoesntHave('roles', function ($q) {
            $q->where('titre', 'Moderateur');
        })
        ->count();

        $moderatorsCount = User::whereHas('roles', function ($q) {
            $q->where('titre', 'Moderateur');
        })->count();

        $terrainsCount = Terrain::all()->count();

        return view('adminDashboard', compact('users', 'membersCount', 'moderatorsCount', 'terrainsCount'));
    }
}
