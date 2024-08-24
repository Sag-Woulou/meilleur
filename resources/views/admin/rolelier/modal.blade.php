<div class="modal fade" id="relieRolePermissionModal" tabindex="-1" role="dialog" aria-labelledby="relieRolePermissionModalTitleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="relieRolePermissionModalTitleLabel">Relier Rôle et Permissions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="rolePermissionForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role_id">Rôle</label>
                        <select id="role_id" name="role_id" class="form-control">
                            <option value="">Sélectionnez un rôle</option>
                            @foreach($allRoles as $allRole)
                                <option value="{{ $allRole->id }}">{{ $allRole->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-role"></span>
                    </div>
                    <!-- Sélection des Permissions avec cases à cocher utilisant Bootstrap Select -->
                    <div class="form-group">
                        <label for="permission_id">Permissions</label>
                        <select id="permission_id" name="permission_id[]" class="form-control selectpicker" multiple data-live-search="true" data-actions-box="true">
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-permissions"></span>
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
