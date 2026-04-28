<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
            'reservationsCount', 'participationsCount',
            'prochainesReservations', 'prochainesParticipations'
        ));
    }

    public function historique(Request $request)
    {
        $transactions = auth()->user()
            ->transactions()
            ->with('transactionnable')
            ->when($request->type, function ($q) use ($request) {
                if ($request->type === 'remboursement') {
                    // Remboursements liés aux participations uniquement
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

    public function points()
    {
        $user = Auth::user();
        return view('joueur_points', compact('user'));
    }

    public function recharge(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:10', // Minimum 10 DH
        ]);

        $montant = $request->montant;
        $points = $montant; // 1 DH = 1 Point

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mad', // Moroccan Dirham
                    'unit_amount' => $montant * 100, // Amount in cents (1 DH = 100 cents)
                    'product_data' => [
                        'name' => 'Recharge de ' . $points . ' Points',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('joueur.points.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('joueur.points.cancel'),
            'metadata' => [
                'user_id' => Auth::id(),
                'montant' => $montant,
                'points' => $points,
            ],
        ]);

        return redirect($checkout_session->url);
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

                // Check if transaction already exists
                $existingTransaction = Transaction::where('reference', $sessionId)->first();

                if (!$existingTransaction) {
                    $user = User::find($userId);
                    $user->pointsCompte += $points;
                    $user->save();

                    Transaction::create([
                        'user_id' => $user->id,
                        'type' => 'recharge',
                        'montant' => $montant,
                        'points' => $points,
                        'reference' => $sessionId,
                        'statut' => 'reussi',
                        'transactionnable_id' => $user->id, // Morph to user as it is a direct recharge
                        'transactionnable_type' => User::class,
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
