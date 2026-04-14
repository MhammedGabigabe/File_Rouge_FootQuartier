<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class JoueurController extends Controller
{
    public function dashboard()
    {
        if (!Auth::user()->estActif) {
            Auth::logout();
            return redirect()->route('connexion')
                ->withErrors(['email' => 'Votre compte a été banni.']);
        }
        
        $user = Auth::user();

        $reservationsCount = $user->reservations()->where('statut', 'confirmee')->count();
        $participationsCount = $user->participations()->where('statut', 'confirmee')->count();

        $prochainesReservations = $user->reservations()
            ->with('terrain')
            ->where('statut', 'confirmee')
            ->where('date_debut', '>=', now())
            ->orderBy('date_debut')
            ->take(3)->get();

        $prochainesParticipations = $user->participations()
            ->with('annonce.reservation.terrain', 'annonce.organisateur')
            ->where('statut', 'confirmee')
            ->whereHas('annonce.reservation', fn($q) => $q->where('date_debut', '>=', now()))
            ->orderBy('created_at', 'desc')
            ->take(3)->get();

        return view('joueur_dashboard', compact(
            'reservationsCount', 'participationsCount',
            'prochainesReservations', 'prochainesParticipations'
        ));
    }
}
