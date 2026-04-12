<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'role'      => User::count() == 0 ? 'nullable' : 'required|in:joueur,moderateur',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Le nom complet est obligatoire.',
            'email.required'     => "L'adresse email est obligatoire.",
            'email.unique'       => 'Cet email est déjà utilisé.',
            'password.min'       => 'Le mot de passe doit faire au moins 8 caractères.',
            'password.required'  => 'Le mot de passe est obligatoire',
            'role.required'      => 'Veuillez choisir un rôle.',
        ];
    }
}
