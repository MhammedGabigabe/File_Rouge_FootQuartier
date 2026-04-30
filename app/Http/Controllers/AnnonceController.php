<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 6;

        $annonces = Annonce::where('statut', 'ouverte')
            ->with([
                'reservation.terrain',
                'organisateur',
                'participations' => function ($q) {
                    $q->where('statut', 'confirmee');
                }
            ])
            ->whereHas('reservation', fn($q) => $q->where('date_debut', '>', now()))
            ->when(
                $request->ville,
                fn($q, $v) =>
                $q->whereHas('reservation.terrain', fn($q2) => $q2->where('localisation', 'like', "%$v%"))
            )
            ->when(
                $request->date,
                fn($q, $d) =>
                $q->whereHas('reservation', fn($q2) => $q2->whereDate('date_debut', $d))
            )
            ->latest()
            ->paginate($perPage);

        return view('joueur_annonces', compact('annonces'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => ['required', 'exists:reservations,id'],
            'places_total' => ['required', 'integer', 'min:1', 'max:22'],
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        if ($reservation->annonce()->exists()) {
            return back()->withErrors([
                'reservation_id' => 'Une annonce existe déjà pour cette réservation.'
            ]);
        }

        if ($reservation->date_debut <= now()->addHours(2)) {
            return back()->withErrors([
                'reservation_id' => 'Impossible de publier une annonce moins de 2h avant le match.'
            ]);
        }
        
        Annonce::create([
            'reservation_id' => $reservation->id,
            'user_id' => Auth::id(),
            'places_total' => $request->places_total,
            'places_dispo' => $request->places_total,
            'statut' => 'ouverte',
        ]);

        return back()->with('success', 'Votre annonce a été publiée avec succès.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
