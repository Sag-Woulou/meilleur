<?php

namespace App\Http\Controllers\TicketController;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketsRequests\TicketUpdateStoreReques;
use App\Models\intervention\Article;
use App\Models\intervention\TypePanneReel;
use App\Models\ticket\Abonne;
use App\Models\ticket\CommentaireTicket;
use App\Models\ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraiterTicketController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tickets = [];

        // Récupérer les services et centres de distribution de l'utilisateur
        $userServices = $user->services->pluck('id');
        $userCentres = $user->centreDistribs->pluck('CENTRE_DISTRIBUTION');
        $userRole = $user->role_id;



        if ($userServices->isEmpty() && $userCentres->isEmpty() && $userRole == null) {
            if ($request->ajax()) {
                return response()->json(['matchingTickets' => collect($tickets), 'articles' => [], 'typePannes' => []]);
            }
            return view('traiterticket.index', ['matchingTickets' => collect($tickets), 'articles' => [], 'typePannes' => []]);
        }

        $searchTerm = $request->input('searchTerm');

        // Construire la requête de base
        $query = DB::table('tickets')
            ->join('abonnes', function ($join) {
                $join->on('tickets.Section', '=', 'abonnes.Section')
                    ->on('tickets.Lot', '=', 'abonnes.Lot')
                    ->on('tickets.Parcelle', '=', 'abonnes.Parcelle')
                    ->on('tickets.Rang', '=', 'abonnes.Rang')
                    ->on('tickets.ExploitationDepannage', '=', 'abonnes.Exploitation');
            })
            ->leftJoin('commentaireTickets', function ($join) {
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
            ->select(
                'tickets.TicketId as id',
                'abonnes.Exploitation',
                'abonnes.Section',
                'abonnes.Lot',
                'abonnes.Parcelle',
                'abonnes.Rang',
                'tickets.CreationDatetime',
                'tickets.NumeroAppelant',
                'typePanne.typePanne',
                'urgence.NiveauUrgence',
                'statutTicket.statutTicket'
            )
            ->where('commentaireTickets.StatutTicketId', 2);

        // Filtrer en fonction des services et centres de distribution pour les non-administrateurs
        if ($userRole != 4) {
            $query->whereIn('tickets.service_id', $userServices)
                ->whereIn('dbo.Centre_distrib.CENTRE_DISTRIBUTION', $userCentres)
                ->where('dbo.Centre_distrib.EXPL_DEPANNAGE', '=', DB::raw('tickets.ExploitationDepannage'));
        }

        // Si un terme de recherche est fourni, appliquer des filtres
        if ($searchTerm) {
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('tickets.NumeroAppelant', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Exploitation', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Section', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Lot', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Parcelle', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Rang', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Grouper et trier les résultats
        $query->groupBy(
            'tickets.TicketId',
            'abonnes.Exploitation',
            'abonnes.Section',
            'abonnes.Lot',
            'abonnes.Parcelle',
            'abonnes.Rang',
            'tickets.CreationDatetime',
            'tickets.NumeroAppelant',
            'typePanne.typePanne',
            'urgence.NiveauUrgence',
            'statutTicket.statutTicket'
        )
            ->orderBy('tickets.TicketId', 'asc')
            ->chunk(100, function ($chunk) use (&$tickets) {
                foreach ($chunk as $ticket) {
                    $tickets[] = $ticket;
                }
            });

        // Convertir le tableau en collection
        $tickets = collect($tickets);
        $articles = Article::all();
        $typePannes = TypePanneReel::all();
        if ($request->ajax()) {
            return response()->json(['matchingTickets' => $tickets]);
        }


        return view('traiterticket.index', ['matchingTickets' => $tickets, 'articles' => $articles, 'typePannes' => $typePannes]);
    }

    public function show($id)
    {
        $ticket = Ticket::with(['commentaires'])->find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket non trouvé'], 404);
        }

        // Récupérer l'abonné avec plusieurs conditions
        $abonne = Abonne::where('Exploitation', $ticket->Exploitation)
            ->where('Section', $ticket->Section)
            ->where('Lot', $ticket->Lot)
            ->where('Parcelle', $ticket->Parcelle)
            ->where('Rang', $ticket->Rang)
            ->first();

        // Récupérer le dernier commentaire trié par statut
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

            // Dernier commentaire
            'DernierCommentaire' => $dernierCommentaire ? [
                'AgentName' => $dernierCommentaire->AgentName ?? 'Non défini',
                'StatutTicketId' => $dernierCommentaire->StatutTicketId ?? 'Non défini',
                'Description' => $dernierCommentaire->Description ?? 'Non défini',
                'CreationDatetime' => $dernierCommentaire->CreationDatetime ?? 'Non défini',
            ] : null,
        ]);
    }


}
