<div class="modal fade @if ($errors->any()) show @endif" tabindex="-1" id="addUserModal"
     role="dialog" style="@if ($errors->any()) display: block; @endif">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalTitleLabel">
                    @if(isset($user))
                        Modifier l'utilisateur
                    @else
                        Ajouter un utilisateur
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form
                @if(isset($user))
                    action="{{ route('users.update', $user->id) }}"
                method="POST"
                @else
                    action="{{ route('users.store') }}"
                method="POST"
                @endif
            >
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="modal-body">
                    <!-- Affichage des messages d'erreur -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control" value="" required>
                        @if($errors->has('nom'))
                            <span class="text-danger">{{ $errors->first('nom') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" value="" required>
                        @if($errors->has('prenom'))
                            <span class="text-danger">{{ $errors->first('prenom') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" name="username" id="username" class="form-control" value="" required>
                        @if($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="" required>
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    @if(!isset($user))
                        <div class="form-group" id="password">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group" id="password_confirmation">
                            <label for="password_confirmation">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="other_user_details">Autres détails</label>
                        <textarea name="other_user_details" id="other_user_details" class="form-control"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">
                        @if(isset($user))
                            Mettre à jour
                        @else
                            Ajouter
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
