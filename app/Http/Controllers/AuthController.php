<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showInscription() {
        return view('inscription');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'nom'         => $request->full_name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
        ]);

        $role = Role::where('titre', $request->role)->first();
        $user->roles()->attach($role->id);

        Auth::login($user);

        if ($request->role == "Membre") {
            return redirect()->route('terrains');
        } else {
            return redirect()->route('attente.approbation');
        }
    }

    

    public function showAttente() {
        if (Auth::user()->estApprouve) {
            return redirect()->route('accueil');
        }
        return view('attente_approbation');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('accueil');
    }    
}
