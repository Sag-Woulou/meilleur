<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterventionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autorisation basée sur les droits de l'utilisateur
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'TicketId' => 'required|integer|exists:tickets,id',
            'CreationDatetime' => 'required|date',
            'Description' => 'nullable|string',
            'user_id' => 'required|integer|exists:users,id',
            'PanneReelsTypePanneId' => 'nullable|integer|exists:types_panne,id',
            'ArtId' => 'nullable|array',
            'ArtId.*' => 'integer|exists:articles,id',
            'nombreArticles' => 'nullable|integer',
            'InterventionStatutId' => 'required|integer|exists:intervention_statuts,id',
        ];
    }

    /**
     * Messages d'erreurs personnalisés.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'TicketId.required' => 'Le champ ID du ticket est obligatoire.',
            'TicketId.exists' => 'Le ticket spécifié n\'existe pas.',
            'CreationDatetime.required' => 'La date de création est obligatoire.',
            'user_id.required' => 'L\'ID de l\'utilisateur est obligatoire.',
            'user_id.exists' => 'L\'utilisateur spécifié n\'existe pas.',
            'InterventionStatutId.required' => 'Le statut de l\'intervention est obligatoire.',
            'InterventionStatutId.exists' => 'Le statut spécifié n\'existe pas.',
            'ArtId.array' => 'Les articles doivent être un tableau.',
            'ArtId.*.exists' => 'L\'article sélectionné est invalide.',
        ];
    }
}
