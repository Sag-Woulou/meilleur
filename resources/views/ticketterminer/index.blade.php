@extends('adminbase.dashboard')

@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Tickets en attente de clôture       {{ $matchingTickets->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    @if($matchingTickets->count() > 0)
                        <table class="table table-responsive-xxl table-striped table-hover">
                            <thead class="table-header">
                            <tr>
                                <th style="width: 120px ;font-weight: bold ">N° du Ticket</th>
                                <th style="font-weight: bold ">Date de Création</th>
                                <th style="font-weight: bold ">Numéro d'Abonné</th>
                                <th style="font-weight: bold ">Numéro d'Appelant</th>
                                <th style="font-weight: bold ">Type de Panne</th>
                                <th style="font-weight: bold ">Niveau d'Urgence</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($matchingTickets as $ticket)
                                <tr>
                                    @php
                                        // Utilisation de 'id' au lieu de 'TicketId' car dans la requête SQL, 'TicketId' est aliasé en 'id'
                                        $ticketNumber = str_pad($ticket->id, 9, '0', STR_PAD_LEFT);
                                        $formattedTicketNumber = substr($ticketNumber, 0, 3) . '-' . substr($ticketNumber, 3, 3) . '-' . substr($ticketNumber, 6);
                                    @endphp
                                    <td>{{ $formattedTicketNumber }}</td>
                                    <td>{{ explode('.', $ticket->CreationDatetime)[0] }}</td>
                                    <td>{{ $ticket->Exploitation . ' ' . $ticket->Section . ' ' . $ticket->Lot . ' ' . $ticket->Parcelle . ' ' . $ticket->Rang }}</td>
                                    <td>{{ $ticket->NumeroAppelant }}</td>
                                    <td>{{ $ticket->typePanne }}</td>
                                    <td style="font-size: 15px">{{ $ticket->NiveauUrgence }}</td>
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
