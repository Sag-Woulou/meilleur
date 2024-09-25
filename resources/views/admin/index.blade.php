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
