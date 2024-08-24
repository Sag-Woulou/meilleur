<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'username' => 'required|regex:/^[a-zA-Z]+[.][a-zA-Z]+$/|max:255|unique:users',
            'other_user_details' => 'nullable|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',

        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.string' => 'Le champ nom doit être une chaîne de caractères.',
            'nom.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',

            'prenom.required' => 'Le champ prénom est obligatoire.',
            'prenom.string' => 'Le champ prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le champ prénom ne doit pas dépasser 255 caractères.',

            'username.required' => 'Le champ nom d\'utilisateur est obligatoire.',
            'username.string' => 'Le champ nom d\'utilisateur doit être une chaîne de caractères.',
            'username.max' => 'Le champ nom d\'utilisateur ne doit pas dépasser 255 caractères.',
            'username.regex' => 'Le champ nom d\'utilisateur doit être au format "texte.texte", avec seulement des lettres et un point.',
            'username.unique' => 'Ce nom d\'utilisateur est déjà utilisé.',

            'other_user_details.string' => 'Le champ autres détails doit être une chaîne de caractères.',

            'email.required' => 'Le champ email est obligatoire.',
            'email.string' => 'Le champ email doit être une chaîne de caractères.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'email.max' => 'Le champ email ne doit pas dépasser 255 caractères.',
            'email.unique' => 'Cet email est déjà utilisé.',

            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.string' => 'Le champ mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',

            'role_id.exists' => 'Le rôle sélectionné est invalide.',
            'role_id.required' => 'Le champ nom est obligatoire.',
        ];
    }

}
