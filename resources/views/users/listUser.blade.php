@extends('adminbase.dashboard')
@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Manage Users</h2>
                            </div>
                            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                <a href="#" id="userModal" class="btn btn-success" data-toggle="modal" data-type="1">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Ajouter un utilisateur</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(isset($message))
                        <div class="alert alert-info">{{ $message }}</div>
                    @endif
                    @if(isset($users) && $users->count() > 0)
                    <table class="table table-responsive-xxl table-striped table-hover">
                        <thead class="table-header">
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                            </th>
                            <th >ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Details</th>
                            <th>Role</th>
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
                                <td>{{ $user->nom }} {{ $user->prenom }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->other_user_details }}</td>
                                <td>{{ $roles->firstWhere('id', $user->role_id)->name }}</td>

                                <th class="action-buttons">
                                    <a href="#" id="userModal" class="view" data-toggle="modal" data-type="3"
                                       data-id="{{ $user->id }}"
                                       data-nom="{{ $user->nom }}"
                                       data-prenom="{{ $user->prenom }}"
                                       data-username="{{ $user->username }}"
                                       data-email="{{ $user->email }}"
                                       data-roleid="{{ $user->role_id  }}"
                                       data-other_user_details="{{ $user->other_user_details }}">
                                        <i class="material-icons" data-toggle="tooltip" title="View">visibility</i>
                                    </a>


                                    <a href="#" class="userModal" id="userModal"
                                       data-type="0"
                                       data-id="{{ $user->id }}"
                                       data-nom="{{ $user->nom }}"
                                       data-prenom="{{ $user->prenom }}"
                                       data-username="{{ $user->username }}"
                                       data-email="{{ $user->email }}"
                                       data-roleid="{{ $user->role_id }}"

                                       data-other_user_details="{{ $user->other_user_details }}">
                                        <i class="material-icons" data-toggle="modal" title="Modifier">edit</i>
                                    </a>

                                    @if((strtolower(auth()->user()->role->name)==="administrateur"))

                                    <a href="#" id="deleteUserModal" class="delete" data-id="{{ $user->id }}" data-toggle="modal">
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">delete_forever</i>
                                    </a>
                                    @endif
                                </th>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        <div class="clearfix">
                            <div class="hint-text">Showing <b>{{ $users->count() }}</b> out of <b>{{ $users->total() }}</b> entries</div>
                            <ul class="pagination">
                                {{-- Render the pagination links --}}
                                {{ $users->links() }}
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
        @include('adminbase.modal')
    @endsection
@endsection
