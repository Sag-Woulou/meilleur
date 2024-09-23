<?php

namespace App\Http\Controllers\TicketController;

use App\Http\Controllers\Controller;
use App\Models\ticket\Abonne;
use App\Models\ticket\Ticket;
use Illuminate\Support\Facades\DB;

class CloturerTicketController extends Controller
{
    public function index()
    {
        $tickets = DB::table('tickets')
            ->join('abonnes', function($join) {
                $join->on('tickets.Section', '=', 'abonnes.Section')
                    ->on('tickets.Lot', '=', 'abonnes.Lot')
                    ->on('tickets.Parcelle', '=', 'abonnes.Parcelle')
                    ->on('tickets.Rang', '=', 'abonnes.Rang')
                    ->on('tickets.ExploitationDepannage','=','abonnes.Exploitation');
            })
            ->leftJoin('commentaireTickets', 'tickets.TicketId', '=', 'commentaireTickets.TicketId')
            ->leftJoin('statutTicket', 'commentaireTickets.StatutTicketId', '=', 'statutTicket.StatutTicketId')
            ->leftJoin('urgence', 'tickets.UrgenceId', '=', 'urgence.UrgenceId')
            ->leftJoin('typePanne', 'tickets.typePanneId', '=', 'typePanne.typePanneId')
            ->select('tickets.TicketId as id', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->where('commentaireTickets.StatutTicketId', 5)
            ->groupBy('tickets.TicketId', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->orderBy('tickets.TicketId', 'asc')
            ->get();

        return view('ticketcloturer.index', ['matchingTickets' => $tickets]);
    }
    public function show($id)
    {
        $ticket = Ticket::with(['commentaires'])->find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket non trouvé'], 404);
        }
        $abonne = Abonne::where('Exploitation', $ticket->Exploitation)
            ->where('Section', $ticket->Section)
            ->where('Lot', $ticket->Lot)
            ->where('Parcelle', $ticket->Parcelle)
            ->where('Rang', $ticket->Rang)
            ->first();
        $dernierCommentaire = $ticket->commentaires->sortByDesc('StatutTicketId')->first();
        return response()->json([
            'TicketId' => $ticket->TicketId ?? 'Non défini',
            'Description' => $ticket->Description ?? 'Non défini',
            'CreationDatetime' => $ticket->CreationDatetime ?? 'Non défini',
            'NumeroAppelant' => $ticket->NumeroAppelant ?? 'Non défini',
            'Rue' => $ticket->Rue ?? 'Non défini',
            'Quartier' => $ticket->Quartier ?? 'Non défini',
            'IndicationPrecise' => $ticket->IndicationPrecise ?? 'Non défini',

            // Informations sur l'abonné
            'NomAbonne' => $abonne->Nom ?? 'Non défini',
            'PrenomAbonne' => $abonne->Prenom ?? 'Non défini',
            'Police' => $abonne->Police ?? 'Non défini',
            'Cle' => $abonne->Cle ?? 'Non défini',
            'NumeroCompteur' => $ticket->Exploitation . ' ' . $ticket->Section . ' ' . $ticket->Lot . ' ' . $ticket->Parcelle . ' ' . $ticket->Rang,
            'TypeCompteur' => $abonne->TypeCompteur ?? 'Non défini',
            'EtatClient' => $abonne->EtatClient ?? 'Non défini',
            'DateEtat' => $abonne->DateEtat ?? 'Non défini',
            'QuartierAbonne' => $abonne->Quartier ?? 'Non défini',
            'TelAbonne' => $abonne->Tel ?? 'Non défini',
            'DernierCommentaire' => $dernierCommentaire ? [
                'AgentName' => $dernierCommentaire->AgentName ?? 'Non défini',
                'StatutTicketId' => $dernierCommentaire->StatutTicketId ?? 'Non défini',
                'Description' => $dernierCommentaire->Description ?? 'Non défini',
                'CreationDatetime' => $dernierCommentaire->CreationDatetime ?? 'Non défini',
            ] : null,
        ]);
    }

}
