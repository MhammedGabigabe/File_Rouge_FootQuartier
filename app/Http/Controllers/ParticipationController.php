<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\Participation;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Annonce $annonce)
    {
        $user = auth()->user();

        if ($annonce->statut !== 'ouverte') {
            return back()->with('error', 'Cette annonce n\'est plus disponible.');
        }

        if ($annonce->places_dispo <= 0) {
            return back()->with('error', 'Il n\'y a plus de places disponibles.');
        }

        if ($annonce->user_id === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas rejoindre votre propre annonce.');
        }

        if ($annonce->participations()->where('user_id', $user->id)->where('statut', 'confirmee')->exists()) {
            return back()->with('error', 'Vous participez déjà à ce match.');
        }

        $terrain = $annonce->reservation->terrain;
        $coutParPlace = round($terrain->prix / ($terrain->capacite * 2));

        if ($user->pointsCompte < $coutParPlace) {
            return back()->with('error', "Solde insuffisant. Il vous faut {$coutParPlace} pts pour rejoindre ce match.");
        }

        DB::transaction(function () use ($annonce, $user, $coutParPlace) {
            $user->decrement('pointsCompte', $coutParPlace);

            $participation = Participation::where('annonce_id', $annonce->id)
                ->where('user_id', $user->id)
                ->first();

            if ($participation) {
                $participation->update([
                    'points_payes' => $coutParPlace,
                    'statut' => 'confirmee',
                ]);
            } else {
                Participation::create([
                    'annonce_id' => $annonce->id,
                    'user_id' => $user->id,
                    'points_payes' => $coutParPlace,
                    'statut' => 'confirmee',
                ]);
            }

            $annonce->decrement('places_dispo');

            if ($annonce->fresh()->places_dispo <= 0) {
                $annonce->update(['statut' => 'complete']);
            }

            $annonce->organisateur->increment('pointsCompte', $coutParPlace);
        });

        return back()->with('success', "Participation confirmée ! {$coutParPlace} pts débités de votre compte.");
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

    public function destroy(Request $request, Annonce $annonce)
    {
        $user = auth()->user();

        $participation = $annonce->participations()
            ->where('user_id', $user->id)
            ->where('statut', 'confirmee')
            ->with('annonce.reservation')
            ->firstOrFail();

        if (!$participation->peutSeRetirer()) {
            return back()->with('error', 'Impossible de se retirer moins de 4h avant le match.');
        }

        DB::transaction(function () use ($annonce, $user, $participation) {
            $user->increment('pointsCompte', $participation->points_payes);
            $annonce->organisateur->decrement('pointsCompte', $participation->points_payes);
            $participation->update(['statut' => 'retiree']);
            $annonce->increment('places_dispo');

            if ($annonce->statut === 'complete') {
                $annonce->update(['statut' => 'ouverte']);
            }
        });

        return back()->with('success', 'Vous vous êtes retiré du match. Vos points ont été remboursés.');
    }
}
