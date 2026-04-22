<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'terrain_id' => ['required', 'exists:terrains,id'],
            'date_debut' => ['required', 'date', 'after_or_equal:today'],
            'date_fin'   => ['required', 'date', 'after:date_debut'],
            'montant'    => ['required', 'numeric', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'terrain_id.required'  => 'Le terrain est requis.',
            'terrain_id.exists'    => 'Ce terrain n\'existe pas.',
            'date_debut.required'  => 'La date de début est requise.',
            'date_debut.after_or_equal' => 'La réservation doit être à partir d\'aujourd\'hui.',
            'date_fin.required'    => 'La date de fin est requise.',
            'date_fin.after'       => 'La date de fin doit être après la date de début.',
            'montant.required'     => 'Le montant est requis.',
            'montant.min'          => 'Le montant doit être supérieur à 0.',
        ];
    }
}
