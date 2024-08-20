<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $userId = $this->user->id;

        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'username' => ['required','regex:/^[a-zA-Z]+\.[a-zA-Z]+$/', 'max:255', Rule::unique('users')->ignore($userId),],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($userId),],
            'other_user_details' => 'nullable|string',
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

        ];
    }
}
