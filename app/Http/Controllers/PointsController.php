<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Transaction;
use App\Models\User;

class PointsController extends Controller
{
    public function paymentIntent(Request $request)
    {
        $request->validate(['montant' => 'required|integer|min:10|max:5000']);

        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount' => $request->montant * 100, // en centimes
            'currency' => 'mad',
            'metadata' => [
                'user_id' => auth()->id(),
                'type' => 'recharge_points',
                'points' => $request->montant,
            ],
        ]);

        return response()->json(['clientSecret' => $intent->client_secret]);
    }

    public function confirm(Request $request)
    {
        $request->validate(['payment_intent_id' => 'required|string']);

        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::retrieve($request->payment_intent_id);

        if ($intent->status !== 'succeeded') {
            return response()->json(['error' => 'Paiement non confirmé.'], 400);
        }

        if ($intent->metadata['user_id'] != auth()->id()) {
            return response()->json(['error' => 'Non autorisé.'], 403);
        }

        $points = (int) $intent->metadata['points'];
        $user = auth()->user();
        $user->increment('pointsCompte', $points);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'recharge',
            'montant' => $points,
            'points' => $points,
            'reference' => $intent->id,
            'statut' => 'reussi',
            'transactionnable_id' => $user->id,
            'transactionnable_type' => 'user',
        ]);

        return response()->json([
            'success' => true,
            'nouveauSolde' => $user->fresh()->pointsCompte,
            'pointsAjoutes' => $points,
        ]);
    }
}