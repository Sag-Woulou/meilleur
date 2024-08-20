@extends('adminbase.dashboard')
@section('tableview')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                            <h2 class="ml-lg-2">Manage Roles</h2>
                        </div>
                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                            <a href="#" id="roleModal" class="btn btn-success" data-toggle="modal" data-type="1">
                                <i class="material-icons">&#xE147;</i>
                                <span>Ajouter un rôle</span>
                            </a>
                        </div>
                    </div>
                </div>
                @if(isset($message))
                    <div class="alert alert-info">{{ $message }}</div>
                @endif
                @if(isset($roles) && $roles->count() > 0)
                    <table class="table table-responsive-xxl table-striped table-hover">
                        <thead class="table-header">
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                            </th>
                            <th >ID</th>
                            <th>Nom</th>
                            <th>Description</th>
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
                                <td>{{ $role->description }}</td>
                                <th class="action-buttons">
                                    <a href="#" id="roleModal" class="view" data-toggle="modal" data-type="3"
                                       data-id="{{ $role->id }}"
                                       data-name="{{ $role->name }}"
                                       data-description="{{ $role->description }}">
                                        <i class="material-icons" data-toggle="tooltip" title="View">visibility</i>
                                    </a>
                                    <a href="#" class="roleModal" id="roleModal"
                                       data-type="0"
                                       data-id="{{ $role->id }}"
                                       data-name="{{ $role->name }}"
                                       data-description="{{ $role->description }}">
                                        <i class="material-icons" data-toggle="modal" title="Modifier">edit</i>
                                    </a>


                                    <a href="#" id="deleteRoleModal" class="delete" data-id="{{ $role->id }}" data-toggle="modal">
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">delete_forever</i>
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="hint-text">Showing <b>{{ $roles->count() }}</b> out of <b>{{ $roles->total() }}</b> entries</div>
                        <ul class="pagination">
                            {{-- Render the pagination links --}}
                            {{ $roles->links() }}
                        </ul>
                    </div>

                @else
                    <div class="no-users-message text-center">
                        No users found.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@section('modal')
    @include('admin.role.modal')
@endsection
@endsection
