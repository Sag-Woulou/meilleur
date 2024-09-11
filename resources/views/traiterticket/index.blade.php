@extends('adminbase.dashboard')

@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Liste des Tickets En attente d'intervention</h2>
                            </div>
                        </div>
                    </div>

                    @if($matchingTickets->count() > 0)
                        <table class="table table-responsive-xxl table-striped table-hover">
                            <thead class="table-header">
                            <tr>
                                <th>N du Ticket</th>
                                <th>Date de Création</th>
                                <th>Numéro d'Abonné</th>
                                <th>Numéro d'Appelant</th>
                                <th>Type de Panne</th>
                                <th>Niveau d'Urgence</th>
                                <th>Dernier Statut</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($matchingTickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->TicketId }}</td>
                                    <td>{{ $ticket->CreationDatetime }}</td>
                                    <td>{{ e($ticket->NumeroCompteur) }}</td> <!-- Affiche les numéros de compteur échappés -->
                                    <td>{{ $ticket->NumeroAppelant }}</td>
                                    <td>{{ $ticket->typePanne }}</td>
                                    <td>{{ $ticket->NiveauUrgence }}</td>
                                    <td>{{ $ticket->statutTicket }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="no-tickets-message text-center">
                            Aucun ticket avec correspondance trouvé.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
@endsection
