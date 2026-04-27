<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showInscription(Request $request) 
    {
        $role = $request->get('role');
        return view('inscription', compact('role'));
    }

    public function showConnexion(Request $request)
    {
        if ($request->has('redirect')) {
            session()->put('url.intended', $request->query('redirect'));
        }
        return view('connexion');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'nom'         => $request->full_name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'stripe_id' => $request->role === 'moderateur' ? $request->stripe_id : null,
        ]);

        if (User::count() == 1) {
            $role = Role::where('titre', 'admin')->first();
            $user->roles()->attach($role->id);
            $user->update(['estApprouve' => true]);
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }
        

        $role = Role::where('titre', $request->role)->first();
        $user->roles()->attach($role->id);

        Auth::login($user);

        if ($request->role == "moderateur") {
            return redirect()->route('attente.approbation');
        }else{
            $user->update(['estApprouve' => true]);
            return redirect()->route('joueur.dashboard');
        }
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if (!$user->estActif) {
                Auth::logout();
                return back()->withErrors(['password' => 'Votre compte a été banni.']);
            }

            if (!$user->estApprouve && $user->isModerateur()) {
                return redirect()->route('attente.approbation');
            }

            if (session()->has('url.intended')) {
                return redirect()->intended();
            }

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->isModerateur()) {
                return redirect()->route('moderator.dashboard');
            }

            return redirect()->intended(route('joueur.dashboard'));
        }

        return back()->withErrors(['password' => 'Identifiants incorrects.'])->onlyInput('email');
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
