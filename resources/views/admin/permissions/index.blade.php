@extends('adminbase.dashboard')
@section('tableview')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                            <h2 class="ml-lg-2">Gestion Permission</h2>
                        </div>
                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                            <a href="#" id="permissionModal" class="btn btn-success" data-toggle="modal" data-type="1">
                                <i class="material-icons">&#xE147;</i>
                                <span>Ajouter une permission</span>
                            </a>
                        </div>
                    </div>
                </div>
                @if(isset($message))
                    <div class="alert alert-info">{{ $message }}</div>
                @endif
                @if(isset($permissions) && $permissions->count() > 0)
                    <table class="table table-responsive-xxl table-striped table-hover">
                        <thead class="table-header">
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                            </th>
                            <th >N°</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="tab-content" id="tab-content">
                        @foreach($permissions as $permission)
                            <tr>
                                <th>
                                    <span class="custom-checkbox">
							        <input type="checkbox" id="checkbox{{ $permission->id }}" name="option[]" value="{{ $permission->id }}">
							        <label for="checkbox{{ $permission->id }}"></label>
                                </th>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description }}</td>
                                <th class="action-buttons">
                                    <a href="#" id="permissionModal" class="view" data-toggle="modal" data-type="3"
                                       data-id="{{ $permission->id }}"
                                       data-name="{{ $permission->name }}"
                                       data-description="{{ $permission->description }}">
                                        <i class="material-icons" data-toggle="tooltip" title="View">visibility</i>
                                    </a>
                                    <a href="#" class="permissionModal" id="permissionModal"
                                       data-type="0"
                                       data-id="{{ $permission->id }}"
                                       data-name="{{ $permission->name }}"
                                       data-description="{{ $permission->description }}">
                                        <i class="material-icons" data-toggle="modal" title="Modifier">edit</i>
                                    </a>


                                    <a href="#" id="deletePermissionModal" class="delete" data-id="{{ $permission->id }}" data-toggle="modal">
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">delete_forever</i>
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="hint-text">Showing <b>{{ $permissions->count() }}</b> out of <b>{{ $permissions->total() }}</b> entries</div>
                        <ul class="pagination">
                            {{-- Render the pagination links --}}
                            {{ $permissions->links() }}
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
    @include('admin.permissions.modal')
@endsection
@endsection
