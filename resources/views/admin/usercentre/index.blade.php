@extends('adminbase.dashboard')

@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Gestion des Utilisateurs et Centres de Distribution</h2>
                            </div>
                            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                <a href="#" id="usercentreModal" class="btn btn-success open-associer-centre-modal" data-type="1" data-toggle="modal" data-target="#associerCentreModal">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Associer Utilisateur</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(isset($userCentreDistribs) && $userCentreDistribs->count() > 0)
                        <table class="table table-responsive-xxl table-striped table-hover">
                            <thead class="table-header">
                            <tr>
                                <th>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="selectAll">
                                        <label for="selectAll"></label>
                                    </span>
                                </th>
                                <th>N°</th>
                                <th>Nom d'utilisateur</th>
                                <th>Centres de Distribution</th>
                                <th>Exploitations de Dépannage</th>
                                <th>Libellé Exploitations</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="tab-content" id="tab-content">
                            @foreach($userCentreDistribs as $userCentreDistrib)
                                <tr>
                                    <th>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="checkbox{{ $userCentreDistrib->id }}" name="option[]" value="{{ $userCentreDistrib->id }}">
                                            <label for="checkbox{{ $userCentreDistrib->id }}"></label>
                                        </span>
                                    </th>
                                    <td>{{ $userCentreDistrib->id }}</td>
                                    <td>{{ $userCentreDistrib->username }}</td>
                                    <td>
                                        <ul>
                                            @foreach($userCentreDistrib->centreDistribs as $centreDistrib)
                                                <li>{{ $centreDistrib->CENTRE_DISTRIBUTION }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($userCentreDistrib->centreDistribs as $centreDistrib)
                                                <li>{{ $centreDistrib->EXPL_DEPANNAGE }} </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($userCentreDistrib->centreDistribs as $centreDistrib)
                                                <li>{{ $centreDistrib->LIBELLE_EXPL_DEPANNAGE}} </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <th class="action-buttons">
                                        <a href="#" id="usercentreModal" class="view" data-toggle="modal" data-type="3"
                                           data-id="{{ $centreDistrib->pivot->id }}"
                                           data-user_id="{{ $userCentreDistrib->id }}"
                                           data-centre_distrib_ids="{{ $centreDistrib->pivot->centre_distrib_id }}">
                                            <i class="material-icons" data-toggle="tooltip" title="View">visibility</i>
                                        </a>
                                        <a href="#" id="usercentreModal" class="edit" data-toggle="modal" data-type="0"
                                           data-id="{{ $userCentreDistrib->id }}"
                                           data-user_id="{{ $userCentreDistrib->id }}"
                                           data-centre_distrib_ids="{{ $centreDistrib->pivot->centre_distrib_id }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Modifier">edit</i>
                                        </a>
                                        <a href="#" id="deleteUsercentreModal" class="delete" data-id="{{ $centreDistrib->pivot->id }}" data-toggle="modal">
                                            <i class="material-icons" data-toggle="tooltip" title="Supprimer">delete_forever</i>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="no-centres-message text-center">
                            Aucun utilisateur trouvé.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('admin.usercentre.modal')
@endsection
