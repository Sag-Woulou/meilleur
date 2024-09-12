<?php

namespace App\Http\Controllers\TicketController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AttenteClientController extends Controller
{
    public function index()
    {
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
            ->select('tickets.TicketId', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->where('commentaireTickets.StatutTicketId', 6)
            ->groupBy('tickets.TicketId', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->orderBy('tickets.TicketId', 'asc')
            ->get();


        return view('ticketcloturer.index', ['matchingTickets' => $tickets]);
    }
}
