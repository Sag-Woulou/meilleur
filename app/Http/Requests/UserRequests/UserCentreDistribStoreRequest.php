<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCentreDistribStoreRequest extends FormRequest
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
            'centre_distrib_id' => 'required|array',
            'centre_distrib_id.*' => 'exists:centre_distrib,id',
        ];
    }

    /**
     * Messages d'erreur personnalisés pour la validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'Le champ utilisateur est obligatoire.',
            'user_id.exists' => 'L\'utilisateur sélectionné est invalide.',
            'centre_distrib_id.required' => 'Au moins un centre de distribution est requis.',
            'centre_distrib_id.array' => 'Les centres de distribution doivent être un tableau.',
            'centre_distrib_id.*.exists' => 'L\'ID du centre de distribution sélectionné est invalide.',
        ];
    }
}
