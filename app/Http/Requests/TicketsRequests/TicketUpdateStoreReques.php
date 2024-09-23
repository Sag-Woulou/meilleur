<?php

namespace App\Http\Requests\TicketsRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


class TicketUpdateStoreReques extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtenez les règles de validation qui s'appliquent à la demande.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $ticketId = $this->route('ticket') ? $this->route('ticket')->TicketId : null;

        return [
            'service_id' => 'required|exists:services,id',
            // Ajoutez d'autres règles de validation selon les besoins
        ];
    }

    /**
     * Personnalisez les messages de validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'ticket_id.required' => 'L\'ID du ticket est requis.',
            'ticket_id.exists' => 'Le ticket spécifié n\'existe pas.',
            'service_id.required' => 'L\'ID du service est requis.',
            'service_id.exists' => 'Le service spécifié n\'existe pas.',
        ];
    }


}
