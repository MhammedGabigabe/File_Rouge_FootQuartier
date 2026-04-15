<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreTerrainRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user && $user->isModerateur();
    }

    public function rules(): array
    {
        return [
            'nom_terrain'      => 'required|string|max:255',
            'localisation'     => 'required|string|max:255',
            'prix'             => 'required|numeric|min:0',
            'capacite'         => 'required|integer|in:5,7,11',
            'description_terr' => 'nullable|string',
            'photo'            => 'nullable|image|max:2048',
            'equipements'      => 'nullable|array',
            'equipements.*'    => 'exists:equipements,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nom_terrain.required' => 'Le nom du terrain est obligatoire.',
            'nom_terrain.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'localisation.required' => 'La localisation est obligatoire.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix doit être supérieur ou égal à 0.',
            'capacite.required' => 'La capacité est obligatoire.',
            'capacite.in' => 'Capacité invalide (5, 7 ou 11 joueurs).',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.max' => 'La taille maximale est 2MB.',
            'equipements.*.exists' => 'Un équipement sélectionné est invalide.',
        ];
    }
}
