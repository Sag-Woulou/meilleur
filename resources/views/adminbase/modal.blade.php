<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="userModalTitleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalTitleLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uniqueForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom">
                            <span class="text-danger" id="error-nom"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez le prénom">
                            <span class="text-danger" id="error-prenom"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Entrez le nom d'utilisateur">
                            <span class="text-danger" id="error-username"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'email">
                            <span class="text-danger" id="error-email"></span>
                        </div>
                    </div>
                    <div class="form-row" id="passwordContent">
                        <!-- Champs Mot de passe et Confirmation sur la même ligne -->
                        <div class="form-group col-md-6">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez le mot de passe">
                            <span class="text-danger" id="error-password"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Confirmation du mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez le mot de passe">
                            <span class="text-danger" id="error-password_confirmation"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Rôle</label>
                        <select class="form-control" id="role_id" name="role_id">
                            <option value="">Sélectionner un rôle</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-role"></span>
                    </div>

                    <div class="form-group">
                        <label for="other_user_details">Autres détails</label>
                        <textarea class="form-control" id="other_user_details" name="other_user_details" placeholder="Autres détails"></textarea>
                        <span class="text-danger" id="error-other_user_details"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" id="saveButton" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
