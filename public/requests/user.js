$(document).on('click', '#userModal', function(event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');
    $('#uniqueForm')[0].reset();
    $('#nom').prop('disabled', false);
    $('#prenom').prop('disabled', false);
    $('#username').prop('disabled', false);
    $('#email').prop('disabled', false);
    $('#other_user_details').prop('disabled', false);
    $('span.text-danger').html('');
    $('#passwordGroup').show();
    $('#passwordConfirmationGroup').show();

    if (dataType === 1) {
        $('#userModalTitleLabel').text('Ajouter un Employé');
        $('#uniqueForm').attr('action', storeUrl);
        $('#uniqueForm').attr('method', 'POST');
        $('#addUserModal').modal('show');
        ajaxFormSubmit('uniqueForm', storeUrl, indexUserUrl,'POST');
        $('#uniqueForm')[0].reset();
        $('#userModal').modal('hide');
    } else if (dataType === 0) {
        var userId = $this.data('id');
        var userName = $this.data('nom');
        var userFirstName = $this.data('prenom');
        var userUsername = $this.data('username');
        var userEmail = $this.data('email');
        var userDetails = $this.data('other_user_details');
        var updateUrl = updateUrlBase.replace('ID', userId);
        $('#userModalTitleLabel').text('Modifier l\'Employé (ID: ' + userId + ')');
        $('#uniqueForm').attr('action', updateUrl);
        $('#uniqueForm').attr('method', 'POST');
        $('#uniqueForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#nom').val(userName);
        $('#prenom').val(userFirstName);
        $('#username').val(userUsername);
        $('#email').val(userEmail);
        $('#other_user_details').val(userDetails);
        $('#passwordGroup').hide();
        $('#passwordConfirmationGroup').hide();
        $('#addUserModal').modal('show');

        ajaxFormSubmit('uniqueForm', updateUrl, indexUserUrl,'POST');

    }else if (dataType === 3) {
        var userId = $this.data('id');
        var userName = $this.data('nom');
        var userFirstName = $this.data('prenom');
        var userUsername = $this.data('username');
        var userEmail = $this.data('email');
        var userDetails = $this.data('other_user_details');
        $('#userModalTitleLabel').text('Employé (ID: ' + userId + ')');
        $('#nom').val(userName);
        $('#nom').prop('disabled', true);
        $('#prenom').val(userFirstName);
        $('#prenom').prop('disabled', true);
        $('#username').val(userUsername);
        $('#username').prop('disabled', true);
        $('#email').val(userEmail);
        $('#email').prop('disabled', true);
        $('#other_user_details').val(userDetails);
        $('#other_user_details').prop('disabled', true);
        $('#passwordGroup').hide();
        $('#passwordConfirmationGroup').hide();
        $('#savebuton').hide();
        $('#addUserModal').modal('show');
    }
});

$(document).on('click', '#roleModal', function(event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');
    $('#uniqueForm')[0].reset();
    $('#name').prop('disabled', false);
    $('#description').prop('disabled', false);
    $('#savebuton').show();
    $('span.text-danger').html('');

    if (dataType === 1) {
        $('#userModalTitleLabel').text('Ajouter un rôle');
        $('#uniqueForm').attr('action', rolestoreUrl);
        $('#uniqueForm').attr('method', 'POST');
        $('#roleModalsow').modal('show');
        ajaxFormSubmit('uniqueForm', rolestoreUrl, indexRolesUrl,'POST');
        $('#uniqueForm')[0].reset();
        $('#roleModal').modal('hide');
    } else if (dataType === 0) {
        var roleId = $this.data('id');
        var name = $this.data('name');
        var description = $this.data('description');
        var roleupdateUrl = roleupdateUrlBase.replace('ID', roleId);
        $('#userModalTitleLabel').text('Modifier le rôle (ID: ' + roleId + ')');
        $('#uniqueForm').attr('action', roleupdateUrl);
        $('#uniqueForm').attr('method', 'POST');
        $('#uniqueForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#name').val(name);
        $('#description').val(description);
        $('#roleModalsow').modal('show');

        ajaxFormSubmit('uniqueForm', roleupdateUrl, indexRolesUrl,'POST');
    }else if (dataType === 3) {
        var roleId = $this.data('id');
        var name = $this.data('name');
        var description = $this.data('description');
        $('#userModalTitleLabel').text('Rôle (ID: ' + roleId + ')');
        $('#name').val(name);
        $('#name').prop('disabled', true);
        $('#description').val(description);
        $('#description').prop('disabled', true);
        $('#savebuton').hide();
        $('#roleModalsow').modal('show');
    }
});

$(document).on('click', '#permissionModal', function(event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');
    $('#uniqueForm')[0].reset();
    $('#name').prop('disabled', false);
    $('#description').prop('disabled', false);
    $('#savebuton').show();
    $('span.text-danger').html('');

    if (dataType === 1) {
        $('#userModalTitleLabel').text('Ajouter une permission');
        $('#uniqueForm').attr('action', permissionstoreUrl);
        $('#uniqueForm').attr('method', 'POST');
        $('#roleModalsow').modal('show');
        ajaxFormSubmit('uniqueForm', permissionstoreUrl, IndexPermissionsUrl, 'POST');
        $('#uniqueForm')[0].reset();
        $('#permissionModal').modal('hide');
    } else if (dataType === 0) {
        var roleId = $this.data('id');
        var name = $this.data('name');
        var description = $this.data('description');
        var permissionupdateUrl = permissionupdateUrlBase.replace('ID', roleId);
        $('#userModalTitleLabel').text('Modifier la permission (ID: ' + roleId + ')');
        $('#uniqueForm').attr('action', permissionupdateUrl);
        $('#uniqueForm').attr('method', 'POST');
        $('#uniqueForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#name').val(name);
        $('#description').val(description);
        $('#roleModalsow').modal('show');

        ajaxFormSubmit('uniqueForm', permissionupdateUrl, IndexPermissionsUrl,'POST');

    }else if (dataType === 3) {
        var roleId = $this.data('id');
        var name = $this.data('name');
        var description = $this.data('description');
        $('#userModalTitleLabel').text('Permission (ID: ' + roleId + ')');
        $('#name').val(name);
        $('#name').prop('disabled', true);
        $('#description').val(description);
        $('#description').prop('disabled', true);
        $('#savebuton').hide();
        $('#roleModalsow').modal('show');
    }
});


$(document).on('click', '#rolePermissionModal', function(event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');
    $('#uniqueForm')[0].reset();
    $('#name').prop('disabled', false);
    $('#description').prop('disabled', false);
    $('#savebuton').show();
    $('span.text-danger').html('');

    if (dataType === 1) {
        $('#userModalTitleLabel').text('Ajouter une liaison entre role et permission');
        $('#uniqueForm').attr('action', permissionstoreUrl);
        $('#uniqueForm').attr('method', 'POST');
        $('#roleModalsow').modal('show');
        ajaxFormSubmit('uniqueForm', permissionstoreUrl, IndexPermissionsUrl, 'POST');
        $('#uniqueForm')[0].reset();
        $('#permissionModal').modal('hide');
    } else if (dataType === 0) {
        var roleId = $this.data('id');
        var name = $this.data('name');
        var description = $this.data('description');
        var permissionupdateUrl = permissionupdateUrlBase.replace('ID', roleId);
        $('#userModalTitleLabel').text('Modifier la permission (ID: ' + roleId + ')');
        $('#uniqueForm').attr('action', permissionupdateUrl);
        $('#uniqueForm').attr('method', 'POST');
        $('#uniqueForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#name').val(name);
        $('#description').val(description);
        $('#roleModalsow').modal('show');

        ajaxFormSubmit('uniqueForm', permissionupdateUrl, IndexPermissionsUrl,'POST');

    }else if (dataType === 3) {
        var roleId = $this.data('id');
        var name = $this.data('name');
        var description = $this.data('description');
        $('#userModalTitleLabel').text('Permission (ID: ' + roleId + ')');
        $('#name').val(name);
        $('#name').prop('disabled', true);
        $('#description').val(description);
        $('#description').prop('disabled', true);
        $('#savebuton').hide();
        $('#roleModalsow').modal('show');
    }
});





setupConfirmation('#deleteUserModal', {
    title: 'Êtes-vous sûr de vouloir supprimer cet utilisateur?',
    text: 'Cette action est irréversible.',
    icon: 'warning',
    confirmButtonText: 'Oui, supprimer!',
    cancelButtonText: 'Annuler',
    successTitle: 'Supprimé!',
    successText: 'L\'utilisateur a été supprimé.'
}, function() {
    var userId = $('#deleteUserModal').data('id');
    console.log('Utilisateur supprimé avec ID:', userId);

},deleteUrlBase, indexUserUrl,'PUT');

setupConfirmation('#deleteRoleModal', {
    title: 'Êtes-vous sûr de vouloir supprimer ce rôle?',
    text: 'Cette action est irréversible.',
    icon: 'warning',
    confirmButtonText: 'Oui, supprimer!',
    cancelButtonText: 'Annuler',
    successTitle: 'Supprimé!',
    successText: 'Le rôle a été supprimé.'
}, function() {
    var roleId = $('#deleteRoleModal').data('id');
    console.log('rôle supprimé avec ID:', roleId);

},roledeleteUrlBase, indexRolesUrl,'PUT');


setupConfirmation('#deletePermissionModal', {
    title: 'Êtes-vous sûr de vouloir supprimer cette permission?',
    text: 'Cette action est irréversible.',
    icon: 'warning',
    confirmButtonText: 'Oui, supprimer!',
    cancelButtonText: 'Annuler',
    successTitle: 'Supprimé!',
    successText: 'La permission a été supprimé.'
}, function() {
    var roleId = $('#deletePermissionModal').data('id');
    console.log('permission supprimé avec ID:', roleId);

},permissiondeleteUrlBase, IndexPermissionsUrl,'PUT');



function ajaxFormSubmit(formId, url, url_, method = 'POST') {
    let $form = $('#' + formId);
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    $form.on('submit', function(e) {
        e.preventDefault();
        $('span.text-danger').html('');
        let formData = $form.serialize() + `&_token=${csrfToken}`;
        let submitButton = $form.find('button[type="submit"]');
        submitButton.prop('disabled', true).text('Envoi...');

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                reloadTable(url_, function() {
                    toastr.success(response.message, 'Succès');
                });
                $form[0].reset();
                $('.modal').modal('hide');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#error-' + key).html(value[0]);
                    });
                } else {
                    toastr.error('Une erreur est survenue. Veuillez réessayer plus tard.');

                }
            },
            complete: function() {
                submitButton.prop('disabled', false).text('Envoyer');
            }
        });
    });
}




function setupConfirmation(selector, options, onConfirm, url, url_, type) {
    $(document).on('click', selector, function(event) {
        event.preventDefault();
        var $this = $(this);
        var userId = $this.data('id');

        Swal.fire({
            title: options.title || 'Êtes-vous sûr?',
            text: options.text || 'Vous ne pourrez pas revenir en arrière!',
            icon: options.icon || 'warning',
            showCancelButton: options.showCancelButton !== false,
            confirmButtonText: options.confirmButtonText || 'Oui, continuez!',
            cancelButtonText: options.cancelButtonText || 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                if (typeof onConfirm === 'function') {
                    onConfirm();
                }
                localStorage.setItem('swalOptions', JSON.stringify({
                    title: options.successTitle || 'Succès!',
                    text: options.successText || 'L\'action a été effectuée avec succès.',
                    icon: 'success'
                }));
                ajaxRequest(userId, url, url_, type);
            }
        });
    });
}

function ajaxRequest(userId, url, url_, type) {
        var deleteUrl = url.replace('ID', userId);
        $.ajax({
            url: deleteUrl,
            type: type,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                reloadTable(url_, function() {
                    let swalOptions = localStorage.getItem('swalOptions');
                    if (swalOptions) {
                        swalOptions = JSON.parse(swalOptions);
                        Swal.fire(swalOptions.title, swalOptions.text, swalOptions.icon);
                        localStorage.removeItem('swalOptions');
                    }
                });
            },
            error: function(xhr) {
                console.error('Une erreur est survenue lors de l\'exécution de l\'action.');
                Swal.fire(
                    'Erreur!',
                    'Une erreur est survenue. Veuillez réessayer plus tard.',
                    'error'
                );
            }
        });

};




function reloadTable(url_, callback) {
    $.ajax({
        url: url_,
        type: 'GET',
        dataType: 'html',
        success: function(data) {
            $('#body').html(data);
            if (typeof callback === 'function') {
                callback();
            }
        },
        error: function(xhr) {
            console.error('Une erreur est survenue lors du chargement du tableau.');
        }
    });
}




$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

