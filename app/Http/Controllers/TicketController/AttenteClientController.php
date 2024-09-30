<?php

namespace App\Http\Controllers\TicketController;
use App\Models\intervention\Article;
use App\Models\intervention\TypePanneReel;
use App\Models\ticket\Abonne;
use App\Http\Controllers\Controller;
use App\Models\ticket\CommentaireTicket;
use App\Models\ticket\Ticket;
use Illuminate\Support\Facades\DB;

class AttenteClientController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // Récupérer les services et centres de distribution de l'utilisateur
        $userServices = $user->services->pluck('id');
        //dd($userServices);
        $userCentres = $user->centreDistribs->pluck('CENTRE_DISTRIBUTION');
        //dd($userCentres);

        if($user->role_id != 4) {

            DB::table('tickets')
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
            // Jointure avec la table Centre_distrib
            ->leftJoin('dbo.Centre_distrib', 'tickets.ExploitationDepannage', '=', 'dbo.Centre_distrib.EXPL_DEPANNAGE')
            ->select('tickets.TicketId as id', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->where('commentaireTickets.StatutTicketId', 2)
            ->whereIn('tickets.service_id', $userServices)
            ->whereIn('dbo.Centre_distrib.CENTRE_DISTRIBUTION', $userCentres) // Correction ici pour utiliser le bon nom de colonne
            ->where('dbo.Centre_distrib.EXPL_DEPANNAGE', '=', DB::raw('tickets.ExploitationDepannage')) // Vérification ici
            ->groupBy('tickets.TicketId', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->orderBy('tickets.TicketId', 'asc')
            ->chunk(100, function ($chunk) use (&$tickets) {
                foreach ($chunk as $ticket) {
                    $tickets[] = $ticket;
                }
            });
        }else{

        DB::table('tickets')
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
            ->select('tickets.TicketId as id', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->where('commentaireTickets.StatutTicketId', 6)
            ->groupBy('tickets.TicketId', 'abonnes.Exploitation', 'abonnes.Section', 'abonnes.Lot',
                'abonnes.Parcelle', 'abonnes.Rang', 'tickets.CreationDatetime', 'tickets.NumeroAppelant',
                'typePanne.typePanne', 'urgence.NiveauUrgence', 'statutTicket.statutTicket')
            ->orderBy('tickets.TicketId', 'asc')
            ->chunk(100, function ($chunk) use (&$tickets) {
                foreach ($chunk as $ticket) {
                    $tickets[] = $ticket;
                }
            });

        }



        // Requête avec jointure supplémentaire sur Centre_distrib


        // Convertir le tableau en collection
        $tickets = collect($tickets);
        $articles = Article::all();
        $typePannes = TypePanneReel::all();


        return view('attenteclient.index', ['matchingTickets' => $tickets, 'articles' => $articles, 'typePannes' => $typePannes]);
    }
}
