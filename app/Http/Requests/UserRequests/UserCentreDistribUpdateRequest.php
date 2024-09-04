<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCentreDistribUpdateRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id', // Validation pour l'utilisateur
            'centre_distrib_ids' => 'required|array', // Validation pour le tableau d'ID de centres de distribution
            'centre_distrib_ids.*' => 'exists:centre_distrib,id', // Validation pour chaque ID de centre de distribution
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
            'centre_distrib_ids.required' => 'Au moins un centre de distribution est requis.',
            'centre_distrib_ids.array' => 'Les centres de distribution doivent être un tableau.',
            'centre_distrib_ids.*.exists' => 'L\'ID du centre de distribution sélectionné est invalide.',
        ];
    }
}
