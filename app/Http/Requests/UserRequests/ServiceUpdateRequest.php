<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
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
     * @return array<string, string>
     */
    public function rules(): array
    {
        $serviceId = $this->route('service') ? $this->route('service')->id : null;

        return [
            'nom' => 'required|string|max:255|unique:services,nom,' . $serviceId,
            'description' => 'nullable|string|max:500',
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
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.string' => 'Le champ nom doit être une chaîne de caractères.',
            'nom.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',
            'nom.unique' => 'Ce nom de service est déjà pris.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne doit pas dépasser 500 caractères.',
        ];
    }
}
