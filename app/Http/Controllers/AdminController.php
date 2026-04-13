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
            $query->where('titre', 'admin');
        })->with('roles')->paginate(4);

        $joueursCount = User::whereHas('roles', function ($q) {
            $q->where('titre', 'joueur');
        })
        ->whereDoesntHave('roles', function ($q) {
            $q->where('titre', 'moderateur');
        })
        ->count();

        $moderatorsCount = User::whereHas('roles', function ($q) {
            $q->where('titre', 'moderateur');
        })->count();

        $terrainsCount = Terrain::count();

        return view('admin_dashboard', compact('users', 'joueursCount', 'moderatorsCount', 'terrainsCount'));
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
        $user->estApprouve = true;
        $user->save();

        return back();
    }

    public function search(Request $request)
    {
        $query = User::with('roles')
            ->whereDoesntHave('roles', function ($q) {
                $q->where('titre', 'admin');
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

        $joueursCount = User::whereHas('roles', function ($q) {
            $q->where('titre', 'joueur');
        })
        ->whereDoesntHave('roles', function ($q) {
            $q->where('titre', 'moderateur');
        })->count();

        $moderatorsCount = User::whereHas('roles', function ($q) {
            $q->where('titre', 'moderateur');
        })->count();

        $terrainsCount = Terrain::count();

        return view('admin_dashboard', compact('users', 'joueursCount', 'moderatorsCount', 'terrainsCount'));
    }
}
