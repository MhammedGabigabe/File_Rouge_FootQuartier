<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\Terrain;
use App\Http\Requests\CheckoutReservationRequest;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function createPaymentIntent(CheckoutReservationRequest $request)
    {
        $terrain = Terrain::with('moderateur')->findOrFail($request->terrain_id);
        $moderateur = $terrain->moderateur;

        if (!$moderateur || !$moderateur->stripe_id) {
            return response()->json(['error' => 'Le modérateur n\'a pas de compte Stripe configuré.'], 422);
        }

        $conflit = Reservation::where('terrain_id', $terrain->id)
            ->where('statut', '!=', 'annulee')
            ->where(function ($q) use ($request) {
                $q->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
                    ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin])
                    ->orWhere(fn($q) => $q->where('date_debut', '<=', $request->date_debut)
                        ->where('date_fin', '>=', $request->date_fin));
            })->exists();

        if ($conflit) {
            return response()->json(['error' => 'Ce créneau est déjà réservé.'], 422);
        }

        if (now()->gt($request->date_debut)) {
            return response()->json(['error' => 'La date de début est dans le passé.'], 422);
        }

        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $montantTotal   = (int) ($request->montant * 100);
            $transferAmount = (int) ($montantTotal * 0.90);

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount'                 => $montantTotal,
                'currency'               => 'mad',
                'application_fee_amount' => $montantTotal - $transferAmount,
                'transfer_data'          => [
                    'destination' => $moderateur->stripe_id,
                ],
                'metadata' => [
                    'terrain_id' => $terrain->id,
                    'user_id'    => auth()->id(),
                    'date_debut' => $request->date_debut,
                    'date_fin'   => $request->date_fin,
                    'montant'    => $request->montant,
                ],
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['error' => 'Erreur Stripe : ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur serveur : ' . $e->getMessage()], 500);
        }
    }

    public function confirmReservation(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $paymentIntent = \Stripe\PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status !== 'succeeded') {
                return response()->json(['error' => 'Paiement non confirmé.'], 422);
            }

            $existing = Reservation::where('stripe_payment_id', $paymentIntent->id)->first();
            if ($existing) {
                return response()->json(['redirect' => route('reservations.success', $existing->id)]);
            }

            $meta = $paymentIntent->metadata;

            $conflit = Reservation::where('terrain_id', $meta->terrain_id)
                ->where('statut', '!=', 'annulee')
                ->where(function ($q) use ($meta) {
                    $q->whereBetween('date_debut', [$meta->date_debut, $meta->date_fin])
                        ->orWhereBetween('date_fin', [$meta->date_debut, $meta->date_fin])
                        ->orWhere(fn($q) => $q->where('date_debut', '<=', $meta->date_debut)
                            ->where('date_fin', '>=', $meta->date_fin));
                })->exists();

            if ($conflit) {
                return response()->json(['error' => 'Ce créneau vient d\'être réservé par quelqu\'un d\'autre.'], 422);
            }

            $reservation = \DB::transaction(function () use ($paymentIntent, $meta) {
                $reservation = Reservation::create([
                    'user_id'           => $meta->user_id,
                    'terrain_id'        => $meta->terrain_id,
                    'date_debut'        => $meta->date_debut,
                    'date_fin'          => $meta->date_fin,
                    'montant'           => $meta->montant,
                    'statut'            => 'confirmee',
                    'date_res'          => now(),
                    'stripe_payment_id' => $paymentIntent->id,
                ]);

                Transaction::create([
                    'user_id'               => $meta->user_id,
                    'type'                  => 'paiement_reservation',
                    'montant'               => $meta->montant,
                    'points'                => 0,
                    'reference'             => $paymentIntent->id,
                    'statut'                => 'reussi',
                    'transactionnable_id'   => $reservation->id,
                    'transactionnable_type' => Reservation::class,
                ]);

                return $reservation;
            });

            return response()->json(['redirect' => route('reservations.success', $reservation->id)]);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['error' => 'Erreur Stripe : ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur serveur : ' . $e->getMessage()], 500);
        }
    }

    public function success($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('reservation_success', compact('reservation'));
    }
}