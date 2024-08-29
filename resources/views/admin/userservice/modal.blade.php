<div class="modal fade" id="relieUserServiceModal" tabindex="-1" role="dialog" aria-labelledby="relieUserServiceModalTitleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="relieUserServiceModalTitleLabel">Relier Utilisateur et Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="userServiceForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">Utilisateur</label>
                        <select id="user_id" name="user_id" class="form-control">
                            <option value="">Sélectionnez un utilisateur</option>
                            @foreach($allUsers as $allUser)
                                <option value="{{ $allUser->id }}">{{ $allUser->username }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-user"></span>
                    </div>
                    <!-- Sélection des Services avec cases à cocher utilisant Bootstrap Select -->
                    <div class="form-group">
                        <label for="service_id">Services</label>
                        <select id="service_id" name="service_id[]" class="form-control selectpicker" multiple data-live-search="true" data-actions-box="true">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->nom }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-services"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button id="savebuton" type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
