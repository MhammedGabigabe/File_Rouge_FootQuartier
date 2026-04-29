<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Transaction;


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
            'reservationsCount',
            'participationsCount',
            'prochainesReservations',
            'prochainesParticipations'
        ));
    }

    public function historique(Request $request)
    {
        $transactions = auth()->user()
            ->transactions()
            ->with('transactionnable')
            ->when($request->type, function ($q) use ($request) {
                if ($request->type === 'remboursement') {
                    $q->where('type', 'remboursement')
                        ->where('transactionnable_type', 'App\\Models\\Participation');
                } else {
                    $q->where('type', $request->type);
                }
            })
            ->when($request->statut, fn($q) => $q->where('statut', $request->statut))
            ->latest()
            ->paginate(4);

        return view('historique', compact('transactions'));
    }

    public function reservations()
    {
        $reservations = Auth::user()
            ->reservations()
            ->with(['terrain', 'annonce'])
            ->orderByDesc('date_debut')
            ->paginate(3);

        return view('joueur_reservations', compact('reservations'));
    }

    public function participations()
    {
        $participations = Auth::user()
            ->participations()
            ->with('annonce.reservation.terrain', 'annonce.organisateur')
            ->where('statut', 'confirmee')
            ->whereHas('annonce.reservation', fn($q) => $q->where('date_debut', '>=', now()))
            ->orderByDesc('created_at')
            ->paginate(6);

        return view('joueur_participations', compact('participations'));
    }

    public function rechargeSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('joueur.points')->with('error', 'Session invalide.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $userId = $session->metadata->user_id;
                $montant = $session->metadata->montant;
                $points = $session->metadata->points;

                $existingTransaction = Transaction::where('reference', $sessionId)->first();

                if (!$existingTransaction) {
                    $user = \App\Models\User::find($userId);
                    $user->pointsCompte += $points;
                    $user->save();

                    Transaction::create([
                        'user_id' => $user->id,
                        'type' => 'recharge',
                        'montant' => $montant,
                        'points' => $points,
                        'reference' => $sessionId,
                        'statut' => 'reussi',
                        'transactionnable_id' => $user->id,
                        'transactionnable_type' => \App\Models\User::class,
                    ]);
                }

                return redirect()->route('joueur.points')->with('success', 'Recharge effectuée avec succès ! Vous avez reçu ' . $points . ' points.');
            }
        } catch (\Exception $e) {
            return redirect()->route('joueur.points')->with('error', 'Erreur lors de la validation du paiement : ' . $e->getMessage());
        }

        return redirect()->route('joueur.points')->with('error', 'Paiement non validé.');
    }

    public function rechargeCancel()
    {
        return redirect()->route('joueur.points')->with('error', 'La recharge a été annulée.');
    }
}
