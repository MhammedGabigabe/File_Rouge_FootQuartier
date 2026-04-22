<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutReservationRequest;
use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\Terrain;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;

class ReservationController extends Controller
{
    public function checkout(CheckoutReservationRequest $request)
    {
        $terrain = Terrain::findOrFail($request->terrain_id);

        $reservation = Reservation::create([
            'user_id'    => auth()->id(),
            'terrain_id' => $terrain->id,
            'date_debut' => $request->date_debut,
            'date_fin'   => $request->date_fin,
            'montant'    => $request->montant,
            'statut'     => 'en_attente',
            'date_res'   => now(),
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'mad',
                    'unit_amount'  => (int) ($request->montant * 100),
                    'product_data' => [
                        'name'        => 'Réservation - ' . $terrain->nom_terrain,
                        'description' => $request->date_debut . ' → ' . $request->date_fin,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => route('reservations.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('terrains.show', $terrain->id),
            'metadata'    => [
                'reservation_id' => $reservation->id,
                'user_id'        => auth()->id(),
            ],
        ]);

        $reservation->update(['stripe_payment_id' => $session->id]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($request->query('session_id'));

        if (!$session || $session->payment_status !== 'paid') {
            return redirect()->route('terrains')->with('error', 'Paiement non confirmé.');
        }

        $reservation = Reservation::where('stripe_payment_id', $session->id)->first();

        if ($reservation && $reservation->statut === 'en_attente') {
            $reservation->update(['statut' => 'confirmee']);

            Transaction::create([
                'user_id'               => $reservation->user_id,
                'type'                  => 'paiement_reservation',
                'montant'               => $reservation->montant,
                'points'                => 0,
                'reference'             => $session->payment_intent,
                'statut'                => 'reussi',
                'transactionnable_id'   => $reservation->id,
                'transactionnable_type' => Reservation::class,
            ]);
        }

        return view('reservations.success', compact('reservation'));
    }
}
