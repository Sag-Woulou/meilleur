
<!-- Modale pour ajouter ou éditer un utilisateur -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="userModalTitleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                        <span class="text-danger" id="error-nom"></span>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom">
                        <span class="text-danger" id="error-prenom"></span>
                    </div>
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" name="username">
                        <span class="text-danger" id="error-username"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <span class="text-danger" id="error-email"></span>
                    </div>
                    <div class="form-group">
                        <label for="other_user_details">Autres détails</label>
                        <textarea class="form-control" id="other_user_details" name="other_user_details"></textarea>
                        <span class="text-danger" id="error-other_user_details"></span>
                    </div>
                    <div class="form-group" id="passwordGroup">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="text-danger" id="error-password"></span>
                    </div>
                    <div class="form-group" id="passwordConfirmationGroup">
                        <label for="password_confirmation">Confirmation du mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <span class="text-danger" id="error-password_confirmation"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" id="savebuton" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>


