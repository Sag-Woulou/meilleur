<?php

namespace App\Http\Controllers\TicketController;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequests\TicketUpdateStoreRequest;
use App\Http\Requests\TicketsRequests\TicketUpdateStoreReques;
use App\Models\ticket\Ticket;
use App\Models\user\Service;
use Illuminate\Support\Facades\DB;

class TransfertController extends Controller
{


    public function index()
    {
        $services=Service::all();
        $tickets = DB::table('tickets')
            ->join('abonnes', function($join) {
                $join->on('tickets.Section', '=', 'abonnes.Section')
                    ->on('tickets.Lot', '=', 'abonnes.Lot')
                    ->on('tickets.Parcelle', '=', 'abonnes.Parcelle')
                    ->on('tickets.Rang', '=', 'abonnes.Rang')
                    ->on('tickets.ExploitationDepannage', '=', 'abonnes.Exploitation');
            })
            ->leftJoin('commentaireTickets', function($join) {
                $join->on('tickets.TicketId', '=', 'commentaireTickets.TicketId')
                    ->whereRaw('commentaireTickets.CreationDatetime = (
                select max(ct.CreationDatetime)
                from commentaireTickets ct
                where ct.TicketId = tickets.TicketId
            )');
            })
            ->leftJoin('statutTicket', 'commentaireTickets.StatutTicketId', '=', 'statutTicket.StatutTicketId')
            ->leftJoin('urgence', 'tickets.UrgenceId', '=', 'urgence.UrgenceId')
            ->leftJoin('typePanne', 'tickets.typePanneId', '=', 'typePanne.typePanneId')
            ->leftJoin('services', 'tickets.service_id', '=', 'services.id') // Ajouter le join avec la table services
            ->select('tickets.TicketId', 'tickets.service_id', 'abonnes.Exploitation', 'abonnes.Section',
                'abonnes.Lot', 'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime',
                'tickets.NumeroAppelant', 'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket',
                'services.nom as service') // Sélection du nom du service
            ->where('commentaireTickets.StatutTicketId', 2)
            ->groupBy('tickets.TicketId', 'tickets.service_id', 'abonnes.Exploitation', 'abonnes.Section',
                'abonnes.Lot', 'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime',
                'tickets.NumeroAppelant', 'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket', 'services.nom')
            ->orderBy('tickets.TicketId', 'asc')
            ->get();


        return view('transferticket.index', ['matchingTickets' => $tickets, 'services' => $services]);
    }

    public function update(TicketUpdateStoreReques $request, $id): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();
        $ticket = Ticket::findOrFail($id);
        $ticket->service_id = $validatedData['service_id'];
        $ticket->save();
        return response()->json(['message' => 'Mise à jour réussie !']);
    }


    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('transferticket.show', compact('ticket'));
    }


}
