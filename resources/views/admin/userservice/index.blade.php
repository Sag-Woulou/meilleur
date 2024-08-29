@extends('adminbase.dashboard')

@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Gérer les Utilisateurs et Services</h2>
                            </div>
                            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                <a href="#" id="relieUserModal" class="btn btn-success" data-toggle="modal"
                                   data-type="1"
                                   data-allUsers="{{ $users }}">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Lier utilisateur et service</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(isset($users) && $users->count() > 0)
                        <table class="table table-responsive-xxl table-striped table-hover">
                            <thead class="table-header">
                            <tr>
                                <th> <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label></th>
                                <th>ID</th>
                                <th>Nom d'utilisateur</th>
                                <th>Services</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="tab-content" id="tab-content">
                            @foreach($users as $user)
                                <tr>
                                    <th>
                                    <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox{{ $user->id }}" name="option[]" value="{{ $user->id }}">
                                    <label for="checkbox{{ $user->id }}"></label>
                                    </th>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <ul>
                                            @foreach($user->services as $service)
                                                <li>{{ $service->nom }}: {{ $service->description }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <th class="action-buttons">
                                        <a href="#" id="relieUserModal" class="view" data-toggle="modal" data-type="3"
                                           data-id="{{ $user->id }}"
                                           data-username="{{ $user->username }}"
                                           data-services="{{ $user->services->pluck('id')->toJson() }}">
                                            <i class="material-icons" data-toggle="tooltip" title="View">visibility</i>
                                        </a>
                                        <a href="#" class="relieUserModal" id="relieUserModal"
                                           data-type="0"
                                           data-id="{{ $user->id }}"
                                           data-username="{{ $user->username }}"
                                           data-services="{{ $user->services->pluck('id')->toJson() }}">
                                            <i class="material-icons" data-toggle="modal" title="Modifier">edit</i>
                                        </a>
                                        <a href="#" id="deleteLienUserService" class="delete"
                                           data-id="{{ $user->id }}"
                                           data-toggle="modal">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">delete_forever</i>
                                        </a>
                                    </th>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    @else
                        <div class="no-services-message text-center">
                            Aucun utilisateur trouvé.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('admin.userservice.modal')
@endsection
