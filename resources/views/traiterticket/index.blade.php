@extends('adminbase.dashboard')
@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Tickets à traiter     {{ $matchingTickets->count() }}</h2>
                            </div>
                        </div>
                    </div>

                    @if($matchingTickets->count() > 0)
                        <table class="table table-responsive-xxl table-striped table-hover">
                            <thead class="table-header">
                            <tr>
                                <th>N° du Ticket</th>
                                <th>Date de Création</th>
                                <th>Numéro d'Abonné</th>
                                <th>Numéro d'Appelant</th>
                                <th>Type de Panne</th>
                                <th>Niveau d'Urgence</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($matchingTickets as $ticket)
                                <tr>
                                    @php
                                        $ticketNumber = str_pad($ticket->id, 9, '0', STR_PAD_LEFT);
                                    @endphp

                                    <td>{{  substr($ticketNumber, 0, 3) . '-' . substr($ticketNumber, 3, 3) . '-' . substr($ticketNumber, 6) }}</td>
                                    <td>{{ explode('.', $ticket->CreationDatetime)[0] }}</td>
                                    <td>{{ $ticket->Exploitation . ' ' . $ticket->Section . ' ' . $ticket->Lot . ' ' . $ticket->Parcelle . ' ' . $ticket->Rang }}</td>
                                    <td>{{ $ticket->NumeroAppelant }}</td>
                                    <td>{{ $ticket->typePanne }}</td>
                                    <td>{{ $ticket->NiveauUrgence }}</td>
                                    <th>
                                        <a href="#" id="ticketDetailsModal" class="view" data-id="{{ $ticket->id }}" data-user="{{auth()->user()->id}}">
                                            <i class="material-icons" data-toggle="tooltip" title="View">visibility</i>
                                        </a>
                                    </th>

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
    @include('traiterticket.modal')
    @include('traiterticket.modalTraiter')
@endsection


