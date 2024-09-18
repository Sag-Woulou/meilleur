@extends('adminbase.dashboard')
@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Liste des Tickets</h2>
                            </div>
                        </div>
                    </div>
                    @if($matchingTickets->count() > 0)
                        <table class="table table-responsive-xxl table-striped table-hover">
                            <thead class="table-header">
                            <tr>
                                <th>Numero du Ticket</th>
                                <th>Date de Création</th>
                                <th>Numéro d'Abonné</th>
                                <th>Service</th> <!-- Changement ici -->
                                <th>Type de Panne</th>
                                <th>Niveau d'Urgence</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($matchingTickets as $ticket)
                                <tr>
                                    @php
                                        $ticketNumber = str_pad($ticket->TicketId, 9, '0', STR_PAD_LEFT);
                                    @endphp

                                    <td>{{  substr($ticketNumber, 0, 3) . '-' . substr($ticketNumber, 3, 3) . '-' . substr($ticketNumber, 6) }}</td>
                                    <td>{{ explode('.', $ticket->CreationDatetime)[0] }}</td>
                                    <td>{{ $ticket->Exploitation . ' ' . $ticket->Section . ' ' . $ticket->Lot . ' ' . $ticket->Parcelle . ' ' . $ticket->Rang }}</td>
                                    <td>{{ $ticket->service }}</td>
                                    <td>{{ $ticket->typePanne }}</td>
                                    <td>{{ $ticket->NiveauUrgence }}</td>
                                    <th class="action-buttons">
                                        <a href="#" id="transfertTicketModal" data-id="{{ $ticket->TicketId }}" data-service_id="{{ $ticket->service_id }}">
                                            <i class="material-icons" data-toggle="modal" title="Modifier">edit</i>
                                        </a>
                                    </th>
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
    @include('transferticket.modal')
@endsection
