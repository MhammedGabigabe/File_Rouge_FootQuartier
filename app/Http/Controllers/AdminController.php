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

        return view('admin_dashboard', compact('users', 'membersCount', 'moderatorsCount', 'terrainsCount'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->estActif = !$user->estActif;
        $user->save();

        return back();
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->estApprouve = 1;
        $user->save();

        return back();
    }

    public function search(Request $request)
    {
        $query = User::with('roles')
            ->whereDoesntHave('roles', function ($q) {
                $q->where('titre', 'Admin');
            });

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->role) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('titre', $request->role);
            });
        }

        $users = $query->paginate(4)->withQueryString();

        // 5. On doit recalculer les compteurs pour que la vue adminDashboard ne plante pas
        $membersCount = User::whereHas('roles', function ($q) {
            $q->where('titre', 'Membre');
        })
        ->whereDoesntHave('roles', function ($q) {
            $q->where('titre', 'Moderateur');
        })->count();

        $moderatorsCount = User::whereHas('roles', function ($q) {
            $q->where('titre', 'Moderateur');
        })->count();

        $terrainsCount = Terrain::count();

        // On retourne la même vue avec les résultats filtrés
        return view('adminDashboard', compact('users', 'membersCount', 'moderatorsCount', 'terrainsCount'));
    }
}
