@extends('adminbase.dashboard')
@section('tableview')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Gestion Services</h2>
                            </div>
                            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                <a href="#" id="serviceModal" class="btn btn-success" data-toggle="modal" data-type="1">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Ajouter un service</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(isset($message))
                        <div class="alert alert-info">{{ $message }}</div>
                    @endif
                    @if(isset($services) && $services->count() > 0)
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
                            @foreach($services as $service)
                                <tr>
                                    <th>
                                    <span class="custom-checkbox">
							        <input type="checkbox" id="checkbox{{ $service->id }}" name="option[]" value="{{ $service->id }}">
							        <label for="checkbox{{ $service->id }}"></label>
                                    </th>
                                    <td>{{ $service->id }}</td>
                                    <td>{{ $service->nom }}</td>
                                    <td>{{ $service->description }}</td>
                                    <th class="action-buttons">
                                        <a href="#" id="serviceModal" class="view" data-toggle="modal" data-type="3"
                                           data-id="{{ $service->id }}"
                                           data-name="{{ $service->nom }}"
                                           data-description="{{ $service->description }}">
                                            <i class="material-icons" data-toggle="tooltip" title="View">visibility</i>
                                        </a>
                                        <a href="#" class="serviceModal" id="serviceModal"
                                           data-type="0"
                                           data-id="{{ $service->id }}"
                                           data-name="{{ $service->nom }}"
                                           data-description="{{ $service->description }}">
                                            <i class="material-icons" data-toggle="modal" title="Modifier">edit</i>
                                        </a>
                                        <a href="#" id="deleteServiceModal" class="delete" data-id="{{ $service->id }}" data-toggle="modal">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">delete_forever</i>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="clearfix">
                            <div class="hint-text">Showing <b>{{ $services->count() }}</b> out of <b>{{ $services->total() }}</b> entries</div>
                            <ul class="pagination">
                                {{-- Render the pagination links --}}
                                {{ $services->links() }}
                            </ul>
                        </div>

                    @else
                        <div class="no-users-message text-center">
                            Aucun Utilisateur trouvé.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @section('modal')
        @include('admin.service.modal')
    @endsection
@endsection
