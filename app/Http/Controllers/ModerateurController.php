<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Avis;
use Illuminate\Support\Facades\Auth;
use App\Models\Terrain;
use App\Models\Equipement;
use Illuminate\Support\Facades\Storage;

class ModerateurController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $terrainsCount = $user->terrains()->where('statut', 'actif')->count();

        $reservationsCount = Reservation::whereHas('terrain', fn($q) =>
            $q->where('moderateur_id', $user->id)
        )->where('statut', 'confirmee')->count();

        $revenusMonth = Reservation::whereHas('terrain', fn($q) =>
            $q->where('moderateur_id', $user->id)
        )->where('statut', 'confirmee')
        ->whereMonth('created_at', now()->month)
        ->sum('montant') * 0.9;

        $avisCount = Avis::whereHas('terrain', fn($q) =>
            $q->where('moderateur_id', $user->id)
        )->count();

        $noteMoyenne = Avis::whereHas('terrain', fn($q) =>
            $q->where('moderateur_id', $user->id)
        )->avg('note') ?? 0;

        $dernieresReservations = Reservation::whereHas('terrain', fn($q) =>
            $q->where('moderateur_id', $user->id)
        )->with('user', 'terrain')
        ->latest()->take(5)->get();

        $derniersAvis = Avis::whereHas('terrain', fn($q) =>
            $q->where('moderateur_id', $user->id)
        )->with('joueur', 'terrain')
        ->latest()->take(4)->get();

        return view('moderateur_dashboard', compact(
            'terrainsCount', 'reservationsCount',
            'revenusMonth', 'avisCount',
            'noteMoyenne', 'dernieresReservations', 'derniersAvis'
        ));
    }

    public function index()
    {
        $terrains = Auth::user()
            ->terrains()
            ->with('equipements')
            ->latest()
            ->get();

        $equipements = Equipement::all();

        return view('moderateur_terrains', compact('terrains', 'equipements'));
    }

    public function destroy($id)
    {
        $terrain = Terrain::where('id', $id)
            ->where('moderateur_id', Auth::id())
            ->firstOrFail();

        if ($terrain->reservations()->where('statut', 'confirmee')
            ->where('date_debut', '>=', now())->exists()) {
            return redirect()->route('moderateur.mesterrains.index')
                ->with('error', 'Impossible de supprimer un terrain avec des réservations à venir.');
        }

        if ($terrain->photo){
            Storage::disk('public')->delete($terrain->photo);
        } 
        $terrain->equipements()->detach();
        $terrain->delete();

        return redirect()->route('moderateur.mesterrains.index')
            ->with('success', 'Terrain supprimé avec succès !');
    }

}
