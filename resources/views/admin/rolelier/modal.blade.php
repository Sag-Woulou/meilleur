<!-- Modal pour ajouter et modifier la liaison entre une permission et un role -->
<div class="modal fade" id="rolePermissionModal" tabindex="-1" role="dialog" aria-labelledby="rolePermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rolePermissionModalLabel">Ajouter des permissions au rôle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rolePermissionForm">
                    <div class="form-group">
                        <label for="role">Rôle</label>
                        <select id="role" name="role" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <select id="permissions" name="permissions[]" class="form-control" multiple>
                        </select>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>
</div>
