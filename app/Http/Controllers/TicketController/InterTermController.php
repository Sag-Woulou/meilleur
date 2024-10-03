<?php

namespace App\Http\Controllers\TicketController;

use App\Models\ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterTermController
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tickets = [];
        $userServices = $user->services->pluck('id');
        $userCentres = $user->centreDistribs->pluck('CENTRE_DISTRIBUTION');
        $userRole = $user->role_id;

        // Vérification des services, centres et rôle de l'utilisateur
        if ($userServices->isEmpty() && $userCentres->isEmpty() && is_null($userRole)) {
            return view('ticketterminer.index', ['matchingTickets' => collect($tickets), 'articles' => [], 'typePannes' => []]);
        }

        // Récupération du terme de recherche
        $searchTerm = $request->input('searchTerm'); // On récupère le terme de recherche

        // Construction de la requête de base pour les tickets
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
                'tickets.TicketId as id', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket'
            )
            ->where('commentaireTickets.StatutTicketId', 4);

        // Si l'utilisateur n'est pas administrateur, appliquer des filtres
        if ($userRole != 4) {
            $query->leftJoin('dbo.Centre_distrib', 'tickets.ExploitationDepannage', '=', 'dbo.Centre_distrib.EXPL_DEPANNAGE')
                ->whereIn('tickets.service_id', $userServices)
                ->whereIn('dbo.Centre_distrib.CENTRE_DISTRIBUTION', $userCentres)
                ->where('dbo.Centre_distrib.EXPL_DEPANNAGE', '=', DB::raw('tickets.ExploitationDepannage'));
        }

        // Si un terme de recherche est fourni, filtrer les tickets
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

        // Récupérer les tickets par chunk pour éviter une surcharge mémoire
        $query->groupBy(
            'tickets.TicketId', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
            'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
            'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket'
        )
            ->orderBy('tickets.TicketId', 'asc')
            ->chunk(100, function ($chunk) use (&$tickets) {
                foreach ($chunk as $ticket) {
                    $tickets[] = $ticket;
                }
            });

        // Convertir le tableau en collection pour l'affichage
        $tickets = collect($tickets);

        return view('ticketterminer.index', ['matchingTickets' => $tickets]);
    }




}
