<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InterventionStoreRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette demande.
     */
    public function authorize(): bool
    {
        return true; // Vous pouvez ajouter une logique d'autorisation si nécessaire
    }

    /**
     * Récupère les règles de validation qui s'appliquent à la demande.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'TicketId' => 'required|integer',
            'user_id' => 'required|integer',
            'PanneReelsTypePanneId' => 'required|integer',
            'articles' => 'required|array',
            'articles.*.ArtId' => 'required|integer|exists:Articles,ArtId',
            'articles.*.quantity' => 'required|integer|min:1',
            'Description' => 'required|string|max:255',
            'InterventionStatutId' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'TicketId.required' => 'Le champ TicketId est obligatoire.',
            'user_id.required' => 'Le champ user_id est obligatoire.',
            'PanneReelsTypePanneId.required' => 'Le champ PanneReelsTypePanneId est obligatoire.',
            'articles.required' => 'Le champ articles est obligatoire.',
            'articles.array' => 'Le champ articles doit être un tableau.',
            'articles.*.ArtId.required' => 'Le champ ArtId est obligatoire pour chaque article.',
            'articles.*.ArtId.exists' => 'L\'article sélectionné n\'existe pas.',
            'articles.*.quantity.required' => 'Le champ quantity est obligatoire pour chaque article.',
            'articles.*.quantity.min' => 'La quantité doit être d\'au moins 1.',
            'Description.required' => 'Le champ commentaire est obligatoire.',
            'Description.max' => 'Le commentaire ne peut pas dépasser 255 caractères.',
        ];
    }
}
