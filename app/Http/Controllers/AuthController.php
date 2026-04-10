<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showInscription() {
        return view('inscription');
    }

    public function showConnexion()
    {
        return view('connexion');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'nom'         => $request->full_name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
        ]);

        if (User::count() == 1) {
            $role = Role::where('titre', 'Admin')->first();
        } else {
            $role = Role::where('titre', $request->role)->first();
        }

        $user->roles()->attach($role->id);

        Auth::login($user);

        if ($request->role == "Membre") {
            return redirect()->route('terrains');
        } elseif($request->role == "Moderateur") {
            return redirect()->route('attente.approbation');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if (!$user->estApprouve && $user->roles()->where('titre', 'Moderateur')->exists()) {
                return redirect()->route('attente.approbation');
            }

            if ($user->roles()->where('titre', 'Admin')->exists()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('/terrains');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.'])->onlyInput('email');
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
