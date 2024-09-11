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
                    ->on('tickets.Rang', '=', 'abonnes.Rang');
            })
            ->leftJoin('commentaireTickets', 'tickets.TicketId', '=', 'commentaireTickets.TicketId')
            ->leftJoin('statutTicket', 'commentaireTickets.StatutTicketId', '=', 'statutTicket.StatutTicketId')
            ->leftJoin('urgence', 'tickets.UrgenceId', '=', 'urgence.UrgenceId')
            ->leftJoin('typePanne', 'tickets.typePanneId', '=', 'typePanne.typePanneId')
            ->select('tickets.TicketId', 'abonnes.NumeroCompteur', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->whereIn('commentaireTickets.StatutTicketId', function($query) {
                $query->select(DB::raw('MAX(ct.StatutTicketId)'))
                    ->from('commentaireTickets as ct')
                    ->whereColumn('ct.TicketId', 'tickets.TicketId');
            })
            ->where('commentaireTickets.StatutTicketId', 6 )
            ->groupBy('tickets.TicketId', 'abonnes.NumeroCompteur', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->orderBy('tickets.TicketId', 'asc')
            ->get();

        return view('traiterticket.index', ['matchingTickets' => $tickets]);
    }
}
