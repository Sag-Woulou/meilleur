<!-- Modale pour associer des permissions à un rôle -->
<div class="modal fade" id="permissionRoleModal" tabindex="-1" role="dialog" aria-labelledby="permissionRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="permissionRoleModalLabel">Associer des Permissions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="permissionRoleForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="permissions">Sélectionner les permissions :</label>
                        <select class="form-control" name="permissions[]" id="permissions" multiple>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-permissions"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" id="savePermissionButton" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
