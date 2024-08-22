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
                        </div>
                    </div>
                    @if(isset($roles) && $roles->count() > 0)
                        <table class="table table-responsive-xxl table-striped table-hover">
                            <thead class="table-header">
                            <tr>
                                <th>ID</th>
                                <th>Nom du Rôle</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="tab-content" id="tab-content">
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if($role->permissions->count() > 0)
                                            <ul>
                                                @foreach($role->permissions as $permission)
                                                    <li>{{ $permission->name }}: {{ $permission->description }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            Aucun permission
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Bouton Modifier -->
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editRoleModal" data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}">Modifier</button>
                                        <!-- Bouton Supprimer -->
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteRoleModal" data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}">Supprimer</button>
                                    </td>
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
