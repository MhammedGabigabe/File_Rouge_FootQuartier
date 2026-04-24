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
            'terrain_id'   => ['required', 'exists:terrains,id'],
            'montant'      => ['required', 'numeric', 'min:1'],
            'date_debut'   => ['required', 'date'],
            'date_fin'     => ['required', 'date', 'after:date_debut'],
        ];
    }

    public function messages(): array
    {
        return [
            'date_debut.required'        => 'La date de début est requise.',
            'date_fin.required'          => 'La date de fin est requise.',
            'date_fin.after'             => 'La date de fin doit être après la date de début.',
        ];
    }
}
