<div class="modal fade" id="associerCentreModal" tabindex="-1" role="dialog" aria-labelledby="associerCentreModalTitleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="associerCentreModalTitleLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="userCentreForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">Utilisateur</label>
                        <select id="user_id" name="user_id" class="form-control">
                            <option value="">Sélectionnez un utilisateur</option>
                            @foreach($allUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-user"></span>
                    </div>
                    <div class="form-group">
                        <label for="centre_distrib_ids">Centres de Distribution</label>
                        <select id="centre_distrib_ids" name="centre_distrib_ids[]" class="form-control selectpicker" multiple data-live-search="true" data-actions-box="true">
                            @foreach($centreDistribs as $centre)
                                <option value="{{ $centre->id }}">
                                    {{ $centre->CENTRE_DISTRIBUTION }} - {{ $centre->EXPL_DEPANNAGE }} - {{ $centre->LIBELLE_EXPL_DEPANNAGE }} - {{$centre->DIST_LIBELLE}}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-centre-distrib"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="dismissUserCentre" type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button id="savebutton" type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
