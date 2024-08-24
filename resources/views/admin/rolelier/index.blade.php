@extends('adminbase.dashboard')

@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Gérer les Rôles et Permissions</h2>
                            </div>
                            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                <a href="#" id="relieRoleModal" class="btn btn-success" data-toggle="modal"
                                   data-type="1"
                                   data-allRoles="{{$roles}}">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Lier rôle et permission</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(isset($roles) && $roles->count() > 0)
                        <table class="table table-responsive-xxl table-striped table-hover">
                            <thead class="table-header">
                            <tr>
                                <th> <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label></th>
                                <th>ID</th>
                                <th>Nom du Rôle</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="tab-content" id="tab-content">
                            @foreach($roles as $role)
                                <tr>
                                    <th>
                                    <span class="custom-checkbox">
							        <input type="checkbox" id="checkbox{{ $role->id }}" name="option[]" value="{{ $role->id }}">
							        <label for="checkbox{{ $role->id }}"></label>
                                    </th>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>

                                            <ul>
                                                @foreach($role->permissions as $permission)
                                                    <li>{{ $permission->name }}: {{ $permission->description }}</li>
                                                @endforeach
                                            </ul>

                                    </td>
                                    <th class="action-buttons">
                                        <a href="#" id="relieRoleModal" class="view" data-toggle="modal" data-type="3"
                                           data-id="{{ $role->id }}"
                                           data-name="{{ $role->name }}"
                                           data-permissions="{{ $role->permissions->pluck('id')->toJson() }}">
                                            <i class="material-icons" data-toggle="tooltip" title="View">visibility</i>
                                        </a>
                                        <a href="#" class="relieRoleModal" id="relieRoleModal"
                                           data-type="0"
                                           data-id="{{ $role->id }}"
                                           data-name="{{ $role->name }}"
                                           data-permissions="{{ $role->permissions->pluck('id')->toJson() }}">
                                            <i class="material-icons" data-toggle="modal" title="Modifier">edit</i>
                                        </a>
                                        <a href="#" id="deletelienRolePermission" class="delete"
                                           data-id="{{ $role->id }}"
                                           data-toggle="modal">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">delete_forever</i>
                                        </a>
                                    </th>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    @else
                        <div class="no-permissions-message text-center">
                            Aucun rôle trouvé.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('admin.rolelier.modal')
@endsection
