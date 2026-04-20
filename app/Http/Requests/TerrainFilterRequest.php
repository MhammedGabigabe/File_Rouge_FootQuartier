<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerrainFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
    return [
        'localisation' => ['nullable', 'string', 'max:100'],
        'capacite'     => ['nullable', 'in:5,7,11'],
        'equipement' => ['nullable', 'string', 'in:vestiaires,eclairage,gazon_synthetique,parking,buvette'],
    ];
    }

    public function messages(): array
    {
        return [
            'capacite.in'        => 'La capacité doit être 5, 7 ou 11.',
            'equipements.*.in'   => 'Équipement invalide.',
        ];
    }
}
