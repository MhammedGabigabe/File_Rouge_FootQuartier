<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TerrainFilterRequest;
use App\Models\Terrain;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class TerrainController extends Controller
{
    public function index(TerrainFilterRequest $request)
    {
        $perPage = Auth::check() ? 3 : 6;

        $terrains = Terrain::query()
            ->when($request->localisation, fn($q, $v) => $q->where('localisation', 'like', "%$v%"))
            ->when($request->capacite, fn($q, $v) => $q->where('capacite', $v))
            ->when(
                $request->equipement,
                fn($q, $v) =>
                $q->whereHas('equipements', fn($eq) => $eq->where('nom', $v))
            )
            ->withCount('avis')
            ->withAvg('avis', 'note')
            ->paginate($perPage)
            ->withQueryString();

        return view('terrains', compact('terrains'));
    }

    public function show($id)
    {
        $terrain = Terrain::withAvg('avis', 'note')
            ->withCount('avis')
            ->with(['equipements', 'avis.joueur'])
            ->findOrFail($id);

        $reservations = Reservation::where('terrain_id', $id)
            ->whereIn('statut', ['confirmee', 'en_attente'])
            ->get()
            ->map(fn($r) => [
                'date' => $r->date_debut->format('Y-m-d'),
                'heure_debut' => (int) $r->date_debut->format('H'),
                'heure_fin' => (int) $r->date_fin->format('H'),
            ]);

        return view('terrains_show', compact('terrain', 'reservations'));
    }
}
