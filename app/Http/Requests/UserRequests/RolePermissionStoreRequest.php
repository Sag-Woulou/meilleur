<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RolePermissionStoreRequest extends FormRequest
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
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|array',
            'permission_id.*' => 'exists:permissions,id',
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => 'Le champ rôle est obligatoire.',
            'role_id.exists' => 'Le rôle sélectionné est invalide.',
            'permission_id.required' => 'Au moins une permission est requise.',
            'permission_id.array' => 'Les permissions doivent être un tableau.',
            'permission_id.*.exists' => 'L\'ID de permission sélectionné est invalide.',
        ];
    }
}
