<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Terrain;
use App\Models\Annonce;

class AccueilController extends Controller
{
    public function index()
    {
        $terrains = Terrain::where('statut', 'actif')
            ->latest()
            ->take(3)
            ->get();

        $annonces = Annonce::where('statut', 'ouverte')
            ->with(['reservation.terrain', 'organisateur'])
            ->whereHas('reservation', fn($q) =>
                $q->where('date_debut', '>', now())
            )
            ->latest()
            ->take(3)
            ->get();

        return view('accueil', compact('terrains', 'annonces'));
    }
}
