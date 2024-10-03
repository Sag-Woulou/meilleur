@extends('adminbase.dashboard')

@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Liste des Tickets Clôture     {{ $matchingTickets->count() }}</h2>
                            </div>
                        </div>
                    </div>

                    @if($matchingTickets->count() > 0)
                        <table class="table table-responsive-xxl table-striped table-hover">
                            <thead class="table-header">
                            <tr>
                                <th style="width: 120px ; font-weight: bold ">N° du Ticket</th>
                                <th style="font-weight: bold">Date de Création</th>
                                <th style="font-weight: bold">Numéro d'Abonné</th>
                                <th style="font-weight: bold">Numéro d'Appelant</th>
                                <th style="font-weight: bold">Type de Panne</th>
                                <th style="font-weight: bold">Niveau d'Urgence</th>
                                <th style="font-weight: bold">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($matchingTickets as $ticket)
                                <tr>
                                    {{-- Formatage du numéro de ticket --}}
                                    @php
                                        // Compléter avec des zéros à gauche si nécessaire
                                        $ticketNumber = str_pad($ticket->id, 9, '0', STR_PAD_LEFT);
                                        // Formater en 000-000-000 sur une seule ligne
                                        $formattedTicketNumber = substr($ticketNumber, 0, 3) . '-' . substr($ticketNumber, 3, 3) . '-' . substr($ticketNumber, 6);
                                    @endphp

                                    <td>{{ $formattedTicketNumber }}</td>
                                    <td>{{ explode('.', $ticket->CreationDatetime)[0] }}</td>
                                    <td>{{ $ticket->Exploitation . ' ' . $ticket->Section . ' ' . $ticket->Lot . ' ' . $ticket->Parcelle . ' ' . $ticket->Rang }}</td>

                                    {{-- Affichage naturel du numéro de téléphone --}}
                                    <td>{{ $ticket->NumeroAppelant }}</td>

                                    <td>{{ $ticket->typePanne }}</td>
                                    <td>{{ $ticket->NiveauUrgence }}</td>
                                    <th>
                                        <a href="#" id="ticketDetailsModal1" class="view" data-id="{{ $ticket->id }}" data-user="{{auth()->user()->id}}" >
                                            <i class="material-icons" data-toggle="tooltip" title="View">visibility</i>
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
    @include('ticketcloturer.modal')
@endsection

