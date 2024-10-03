<?php

namespace App\Http\Controllers\TicketController;
use App\Models\intervention\Article;
use App\Models\intervention\TypePanneReel;
use App\Models\ticket\Abonne;
use App\Http\Controllers\Controller;
use App\Models\ticket\CommentaireTicket;
use App\Models\ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttenteClientController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tickets = [];

        // Récupérer les services et centres de distribution de l'utilisateur
        $userServices = $user->services->pluck('id');
        $userCentres = $user->centreDistribs->pluck('CENTRE_DISTRIBUTION');
        $userRole = $user->role_id;

        // Vérification si l'utilisateur n'est pas associé à un service, un centre de distribution ou un rôle
        if ($userServices->isEmpty() && $userCentres->isEmpty() && is_null($userRole)) {
            // Retourner un tableau vide si aucune association n'existe
            return view('attenteclient.index', ['matchingTickets' => collect($tickets), 'articles' => [], 'typePannes' => []]);
        }

        $searchTerm = $request->input('searchTerm');


        // Construction de la requête de base
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
                    SELECT MAX(ct.CreationDatetime)
                    FROM commentaireTickets ct
                    WHERE ct.TicketId = tickets.TicketId
                )');
            })
            ->leftJoin('statutTicket', 'commentaireTickets.StatutTicketId', '=', 'statutTicket.StatutTicketId')
            ->leftJoin('urgence', 'tickets.UrgenceId', '=', 'urgence.UrgenceId')
            ->leftJoin('typePanne', 'tickets.typePanneId', '=', 'typePanne.typePanneId')
            ->select('tickets.TicketId as id', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->where('commentaireTickets.StatutTicketId', 6);

        // Appliquer des filtres en fonction du rôle
        if ($userRole != 4) { // Si l'utilisateur n'est pas un administrateur
            $query->whereIn('tickets.service_id', $userServices)
                ->whereIn('abonnes.Exploitation', $userCentres)
                ->where('abonnes.Exploitation', '=', DB::raw('tickets.ExploitationDepannage'));
        }

        // Appliquer la recherche si un terme est fourni
        if ($searchTerm) {
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('tickets.NumeroAppelant', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tickets.TicketId', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Exploitation', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Section', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Lot', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Parcelle', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('abonnes.Rang', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Exécution de la requête et récupération des tickets
        $tickets = $query->groupBy('tickets.TicketId', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
            'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
            'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->orderBy('tickets.TicketId', 'asc')
            ->get();

        // Récupérer les articles et types de panne
        $articles = Article::all();
        $typePannes = TypePanneReel::all();

        return view('attenteclient.index', ['matchingTickets' => collect($tickets), 'articles' => $articles, 'typePannes' => $typePannes]);
    }
}
