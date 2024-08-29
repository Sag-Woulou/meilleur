<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserServiceUpdateRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour la requête.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'service_ids' => 'required|array',
            'service_ids.*' => 'exists:services,id',
        ];
    }

    /**
     * Messages de validation personnalisés.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'Le champ utilisateur est obligatoire.',
            'user_id.exists' => 'L\'utilisateur sélectionné est invalide.',
            'service_ids.required' => 'Au moins un service est requis.',
            'service_ids.array' => 'Les services doivent être un tableau.',
            'service_ids.*.exists' => 'L\'ID de service sélectionné est invalide.',
        ];
    }
}
