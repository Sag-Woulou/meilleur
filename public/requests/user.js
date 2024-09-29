$(document).on('click', '#userModal', function (event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');
    $('#uniqueForm')[0].reset();
    $('#nom').prop('disabled', false);
    $('#prenom').prop('disabled', false);
    $('#username').prop('disabled', false);
    $('#email').prop('disabled', false);
    $('#role_id').prop('disabled', false);
    $('#other_user_details').prop('disabled', false);
    $('span.text-danger').html('');
    $('#password').show();
    $('#password_confirmation').show();

    if (dataType === 1) {
        $('#userModalTitleLabel').text('Ajouter un Employé');
        $('#uniqueForm').attr('action', storeUrl);
        $('#uniqueForm').attr('method', 'POST');
        $('#addUserModalShow').modal('show');
        ajaxFormSubmit('uniqueForm', storeUrl, indexUserUrl, 'POST');
        $('#uniqueForm')[0].reset();
        $('#addUserModalShow').modal('hide');
    } else if (dataType === 0) {
        var userId = $this.data('id');
        var userName = $this.data('nom');
        var userFirstName = $this.data('prenom');
        var userUsername = $this.data('username');
        var userEmail = $this.data('email');
        var roleid = $this.data('roleid');
        console.log('role_id', roleid);
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
        $('#role_id').val(roleid);
        $('#other_user_details').val(userDetails);
        $('#passwordContent').hide();
        $('#addUserModalShow').modal('show');

        ajaxFormSubmit('uniqueForm', updateUrl, indexUserUrl, 'POST');

    } else if (dataType === 3) {
        var userId = $this.data('id');
        var userName = $this.data('nom');
        var userFirstName = $this.data('prenom');
        var userUsername = $this.data('username');
        var userEmail = $this.data('email');
        var roleid = $this.data('roleid');
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
        $('#role_id').val(roleid);
        $('#role_id').prop('disabled', true);
        $('#other_user_details').val(userDetails);
        $('#other_user_details').prop('disabled', true);
        $('#passwordContent').hide();
        $('#savebuton').hide();
        $('#addUserModalShow').modal('show');
    }
});
$(document).on('click', '#dismissModalAddUser', function (event) {
    event.preventDefault();
    $('#addUserModalShow').modal('hide');

});
$(document).on('click', '#traiterButton2', function (event) {
    event.preventDefault();
    var $this = $(this);
    var id = $this.data('id');
    $('#TicketId').val(id);
    $('#InterventionCreate').text('Informations du ticket  (N: ' + id + ')');
    console.log(id)

})

$(document).on('click', '#roleModal', function (event) {
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
        ajaxFormSubmit('uniqueForm', rolestoreUrl, indexRolesUrl, 'POST');
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

        ajaxFormSubmit('uniqueForm', roleupdateUrl, indexRolesUrl, 'POST');
    } else if (dataType === 3) {
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
$(document).on('click', '#permissionModal', function (event) {
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

        ajaxFormSubmit('uniqueForm', permissionupdateUrl, IndexPermissionsUrl, 'POST');

    } else if (dataType === 3) {
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
$(document).on('click', '#relieRoleModal', function (event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');
    $('#rolePermissionForm')[0].reset();
    $('#role_id').prop('disabled', false);
    $('#permission_id').prop('disabled', false);
    $('#savebuton').show();
    $('span.text-danger').html('');

    if (dataType === 1) {
        $('#relieRolePermissionModalTitleLabel').text('Ajouter lien rôle-Permission');
        $('#rolePermissionForm').attr('action', rolepermissionstoreUrl);
        $('#rolePermissionForm').attr('method', 'POST');
        $('#relieRolePermissionModal').modal('show');
        ajaxFormSubmit('rolePermissionForm', rolepermissionstoreUrl, IndexRolePermissionUrl, 'POST');
        $('#rolePermissionForm')[0].reset();
        $('#relieRolePermissionModal').modal('hide');
    } else if (dataType === 0) {
        var roleId = $this.data('id');
        var permissions = $this.data('permissions');
        console.log('permissions', permissions.id);
        var roleupdateUrl = rolepermissionupdateUrlBase.replace('ID', roleId);
        $('#relieRolePermissionModalTitleLabel').text('Modifier lien rôle-Permission (ID: ' + roleId + ')');
        $('#rolePermissionForm').attr('action', roleupdateUrl);
        $('#rolePermissionForm').attr('method', 'POST');
        $('#rolePermissionForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#role_id').val(roleId);
        $('#permission_id').val(permissions);
        $('#relieRolePermissionModal').modal('show');

        ajaxFormSubmit('rolePermissionForm', roleupdateUrl, IndexRolePermissionUrl, 'POST');
    } else if (dataType === 3) {
        var roleId = $this.data('id');
        var permissions = $this.data('permissions');
        $('#relieRolePermissionModalTitleLabel').text('Lien rôle-Permission (ID: ' + roleId + ')');
        $('#role_id').val(roleId);
        $('#role_id').prop('disabled', true);
        $('#permission_id').val(permissions);
        $('#permission_id').prop('disabled', true);
        $('#savebuton').hide();
        $('#relieRolePermissionModal').modal('show');
    }
});
$(document).on('click', '#serviceModal', function (event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');
    var serviceId = $this.data('id');
    var name = $this.data('name');
    var description = $this.data('description');

    $('#serviceForm')[0].reset();
    $('#name').prop('disabled', false);
    $('#description').prop('disabled', false);
    $('#savebuton').show();
    $('span.text-danger').html('');

    if (dataType === 1) {
        $('#serviceModalTitleLabel').text('Ajouter un service');
        $('#serviceForm').attr('action', servicestoreUrl);
        $('#serviceForm').attr('method', 'POST');
        $('#serviceModalsow').modal('show');
        ajaxFormSubmit('serviceForm', servicestoreUrl, indexServicesUrl, 'POST');
        $('#serviceForm')[0].reset();
        $('#serviceModal').modal('hide');
    } else if (dataType === 0) {
        var serviceupdateUrl = serviceupdateUrlBase.replace('ID', serviceId);
        $('#serviceModalTitleLabel').text('Modifier le service (ID: ' + serviceId + ')');
        $('#serviceForm').attr('action', serviceupdateUrl);
        $('#serviceForm').attr('method', 'POST');
        $('#serviceForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#nom').val(name);
        $('#description').val(description);
        $('#serviceModalsow').modal('show');
    } else if (dataType === 3) {
        $('#serviceModalTitleLabel').text('Service (ID: ' + serviceId + ')');
        $('#nom').val(name).prop('disabled', true);
        $('#description').val(description).prop('disabled', true);
        $('#savebuton').hide();
        $('#serviceModalsow').modal('show');
    }
});
$(document).on('click', '#relieUserModal', function (event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');

    // Reset du formulaire et réinitialisation des éléments de formulaire
    $('#userServiceForm')[0].reset();
    $('#user_id').prop('disabled', false);
    $('#service_id').prop('disabled', false);
    $('#savebuton').show();
    $('span.text-danger').html('');

    if (dataType === 1) {
        // Cas pour ajouter un lien utilisateur-service
        $('#relieUserServiceModalTitleLabel').text('Ajouter lien utilisateur-Service');
        $('#userServiceForm').attr('action', userservicestoreUrl);
        $('#userServiceForm').attr('method', 'POST');
        $('#relieUserServiceModal').modal('show');

        // Soumission du formulaire via AJAX avec POST
        ajaxFormSubmit('userServiceForm', userservicestoreUrl, indexUserServicesUrl, 'POST');

        $('#userServiceForm')[0].reset();
        $('#relieUserServiceModal').modal('hide');
    } else if (dataType === 0) {
        // Cas pour modifier un lien utilisateur-service existant
        var userId = $this.data('id');
        var services = $this.data('services');
        var userupdateUrl = userserviceupdateUrlBase.replace('ID', userId);

        $('#relieUserServiceModalTitleLabel').text('Modifier lien utilisateur-Service (ID: ' + userId + ')');
        $('#userServiceForm').attr('action', userupdateUrl);
        $('#userServiceForm').attr('method', 'POST');
        $('#userServiceForm').append('<input type="hidden" name="_method" value="PUT">'); // Utiliser PUT pour la mise à jour
        $('#user_id').val(userId);
        $('#service_id').val(services).change();
        $('#relieUserServiceModal').modal('show');

        // Soumission du formulaire via AJAX avec PUT déguisé en POST
        ajaxFormSubmit('userServiceForm', userupdateUrl, indexUserServicesUrl, 'POST');
    } else if (dataType === 3) {
        // Cas pour afficher les détails du lien utilisateur-service sans possibilité de modification
        var userId = $this.data('id');
        var services = $this.data('services');

        $('#relieUserServiceModalTitleLabel').text('Lien utilisateur-Service (ID: ' + userId + ')');
        $('#user_id').val(userId);
        $('#user_id').prop('disabled', true);
        $('#service_id').val(services).prop('disabled', true).change();
        $('#savebuton').hide();
        $('#relieUserServiceModal').modal('show');
    }
});
/*$(document).on('click', '#usercentreModal', function (event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');
    $('#userCentreForm')[0].reset(); // Reset le formulaire
    $('#user_id').prop('disabled', false);
    $('#centre_distrib_ids').prop('disabled', false);
    $('#savebutton').show(); // Affiche le bouton enregistrer
    $('span.text-danger').html(''); // Reset des erreurs

    // Si dataType est égal à 1, on est dans le cas de création
    if (dataType === 1) {
        $('#associerCentreModalTitleLabel').text('Associer Utilisateur et Centres de Distribution');
        $('#userCentreForm').attr('action', userCentrestoreUrl); // URL pour créer l'association
        $('#userCentreForm').attr('method', 'POST'); // Méthode POST pour la création
        $('#associerCentreModal').modal('show'); // Ouvre le modal
        ajaxFormSubmit('serviceForm', userCentrestoreUrl, indexUserCentresUrl, 'POST');
        $('#userCentreForm')[0].reset(); // Reset le formulaire après soumission
        $('#associerCentreModal').modal('hide'); // Ferme le modal
    }
    // Si dataType est égal à 0, on est dans le cas de l'édition
    else if (dataType === 0) {
        var id = $this.data('id');
        var userId = $this.data('user_id');
        var centreDistribIds = $this.data('centre_distrib_ids');
        console.log('centreDistribIds', centreDistribIds);

        var userCentreupdateUrlBaseUrl = userCentreupdateUrlBase.replace('ID', id); // Remplace ID par l'id réel
        $('#associerCentreModalTitleLabel').text('Modifier lien Utilisateur-Centres (ID: ' + id + ')');
        $('#userCentreForm').attr('action', userCentreupdateUrlBaseUrl); // URL pour la mise à jour
        $('#userCentreForm').attr('method', 'POST'); // Méthode POST pour l'édition
        $('#userCentreForm').append('<input type="hidden" name="_method" value="PUT">'); // Pour que Laravel utilise PUT
        $('#user_id').val(userId); // Remplit le champ utilisateur
        $('#centre_distrib_ids').val(centreDistribIds); // Remplit le champ centres
        $('#associerCentreModal').modal('show'); // Ouvre le modal

        ajaxFormSubmit('userCentreForm', userCentreupdateUrlBaseUrl, indexUserCentresUrl, 'POST'); // Soumission du formulaire
    }
});*/

$(document).on('click', '#dismissUserCentre', function (event) {
    event.preventDefault();
    reloadTable_(indexUserCentresUrl);

});
$(document).on('click', '#transfertTicketModal', function (event) {
    console.log(true);
    event.preventDefault();
    var $this = $(this);
    var id = $this.data('id');
    var service_id = $this.data('service_id');
    console.log("service_id", service_id);
    var updateTicketUrlUrlBaseUrl = updateTicketUrl.replace('ID', id);
    $('#transfertModalForm').attr('action', updateTicketUrlUrlBaseUrl);
    $('#transfertModalForm').attr('method', 'POST');
    $('#transfertModalForm').append('<input type="hidden" name="_method" value="PUT">');
    $('#service_id').val(service_id);
    $('#transfertModal').modal('show');

    var newservice_id = $('#service_id').val();
    console.log("newservice_id", newservice_id);
    ajaxFormSubmit('transfertModalForm', updateTicketUrlUrlBaseUrl, indexTransfertUrl, 'POST')

});
$(document).on('click', '#fermermodaltransferer', function (event) {
    event.preventDefault();
    reloadTable_(indexTransfertUrl);

});

function showTicketDetails(ticketId) {
    if (!ticketId) {
        console.error('ID du ticket non défini');
        return;
    }
    resetModalContent();

    // Remplacer :id par l'ID du ticket dans l'URL générée par Laravel
    var url = ticketUrl.replace(':id', ticketId);

    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log('Réponse du serveur : ', response);

            // Remplir les détails du ticket
            $('#ticketId').text(response.TicketId || 'Non défini');
            $('#ticketDescription').text(response.Description || 'Non défini');
            $('#ticketCreationDatetime').text(response.CreationDatetime || 'Non défini');
            $('#ticketNumeroAppelant').text(response.NumeroAppelant || 'Non défini');
            $('#ticketRue').text(response.Rue || 'Non défini');
            $('#ticketQuartier').text(response.Quartier || 'Non défini');
            $('#ticketIndicationPrecise').text(response.IndicationPrecise || 'Non défini');

            // Remplir les détails de l'abonné
            $('#abonneNom').text(response.NomAbonne || 'Non défini');
            $('#abonnePrenom').text(response.PrenomAbonne || 'Non défini');
            $('#abonnePolice').text(response.Police || 'Non défini');
            $('#abonneCle').text(response.Cle || 'Non défini');
            $('#abonneNumeroCompteur').text(response.NumeroCompteur || 'Non défini');
            $('#abonneTypeCompteur').text(response.TypeCompteur || 'Non défini');
            $('#abonneEtatClient').text(response.EtatClient || 'Non défini');
            $('#abonneDateEtat').text(response.DateEtat || 'Non défini');
            $('#abonneQuartier').text(response.QuartierAbonne || 'Non défini');
            $('#abonneTel').text(response.TelAbonne || 'Non défini');

            // Dernier commentaire
            if (response.DernierCommentaire) {
                $('#commentaireDetails').html(`
                    <div>
                        <strong>Agent:</strong> ${response.DernierCommentaire.AgentName || 'Non défini'}<br>
                        <strong>Description:</strong> ${response.DernierCommentaire.Description || 'Non défini'}<br>
                        <strong>Date de Création:</strong> ${response.DernierCommentaire.CreationDatetime || 'Non défini'}<br>
                    </div>
                    <hr>
                `);
            } else {
                $('#commentaireDetails').html('<p>Aucun commentaire disponible.</p>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Erreur lors de la récupération des détails du ticket :', xhr.responseText);
            $('#ticketError').html(`
                <div class="alert alert-danger" role="alert">
                    Impossible de charger les détails du ticket. Veuillez réessayer.
                </div>
            `);
        }
    });
}

function resetModalContent() {
    $('#ticketId').text('');
    $('#ticketDescription').text('');
    $('#ticketNumeroAppelant').text('');
    $('#indicationPrecise').text('');
    $('#quartier').text('');

    $('#abonneNom').text('');
    $('#abonnePrenom').text('');
    $('#police').text('');
    $('#numeroCompteur').text('');
    $('#etatClient').text('');
    $('#dateEtat').text('');
    $('#quartierAbonne').text('');
    $('#telAbonne').text('');

    $('#commentaireDetails').html('');
}

$(document).on('click', '#ticketDetailsModal', function (event) {
    event.preventDefault();
    $('#ticketDetailsModalwee').modal('show');
    var ticketId = $(this).data('id');
    showTicketDetails(ticketId);
});
$(document).on('click', '#dismissButton', function (event) {
    event.preventDefault();
    reloadTable_(indexTraiterticketUrl);
    $('#ticketDetailsModalwee').hide();
});

function showTicketDetails1(ticketId) {
    if (!ticketId) {
        console.error('ID du ticket non défini');
        return;
    }
    resetModalContent();

    $.ajax({
        url: `/traiterticket/${ticketId}`,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log('Réponse du serveur : ', response);

            // Remplir les détails du ticket
            $('#ticketId1').text(response.TicketId || 'Non défini');
            $('#ticketDescription1').text(response.Description || 'Non défini');
            $('#ticketCreationDatetime1').text(response.CreationDatetime || 'Non défini');
            $('#ticketNumeroAppelant1').text(response.NumeroAppelant || 'Non défini');
            $('#ticketRue1').text(response.Rue || 'Non défini');
            $('#ticketQuartier').text(response.Quartier || 'Non défini');
            $('#ticketIndicationPrecise1').text(response.IndicationPrecise || 'Non défini');

            // Remplir les détails de l'a1bonné
            $('#abonneNom1').text(response.NomAbonne || 'Non défini');
            $('#abonnePrenom1').text(response.PrenomAbonne || 'Non défini');
            $('#abonnePolice1').text(response.Police || 'Non défini');
            $('#abonneCle1').text(response.Cle || 'Non défini');
            $('#abonneNumeroCompteur1').text(response.NumeroCompteur || 'Non défini');
            $('#abonneTypeCompteur1').text(response.TypeCompteur || 'Non défini');
            $('#abonneEtatClient1').text(response.EtatClient || 'Non défini');
            $('#abonneDateEtat1').text(response.DateEtat || 'Non défini');
            $('#abonneQuartier1').text(response.QuartierAbonne || 'Non défini');
            $('#abonneTel1').text(response.TelAbonne || 'Non défini');

            // Dernier commentaire
            if (response.DernierCommentaire) {
                $('#commentaireDetails1').html(`
                    <div>
                        <strong>Agent:</strong> ${response.DernierCommentaire.AgentName || 'Non défini'}<br>
                        <strong>Description:</strong> ${response.DernierCommentaire.Description || 'Non défini'}<br>
                        <strong>Date de Création:</strong> ${response.DernierCommentaire.CreationDatetime || 'Non défini'}<br>
                    </div>
                    <hr>
                `);
            } else {
                $('#commentaireDetails1').html('<p>Aucun commentaire disponible.</p>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Erreur lors de la récupération des détails du ticket :', xhr.responseText);
            $('#ticketError').html(`
                <div class="alert alert-danger" role="alert">
                    Impossible de charger les détails du ticket. Veuillez réessayer.
                </div>
            `);
        }
    });
}

function resetModalContent1() {
    $('#ticketId1').text('');
    $('#ticketDescription1').text('');
    $('#ticketNumeroAppelant1').text('');
    $('#indicationPrecise1').text('');
    $('#quartier1').text('');

    $('#abonneNom1').text('');
    $('#abonnePrenom1').text('');
    $('#police1').text('');
    $('#numeroCompteur1').text('');
    $('#etatClient1').text('');
    $('#dateEtat1').text('');
    $('#quartierAbonne1').text('');
    $('#telAbonne1').text('');

    $('#commentaireDetails1').html('');
}

$(document).on('click', '#ticketDetailsModal1', function (event) {
    event.preventDefault();

    $('#ticketDetailsModalwee12').modal('show');
    var ticketId = $(this).data('id');
    showTicketDetails1(ticketId);
    reloadTable_(indexTraiterticketUrl);
});
$(document).on('click', '#dismissButton1', function (event) {
    event.preventDefault();
    reloadTable_(indexticketcloturerUrl);

});
$(document).on('click', '#traiterButton2', function (event) {
    event.preventDefault();
    $('#ticketDetailsModalwee').hide();
    console.log(true);
    $('#ticketTraiterModalwee5').modal('show');
});

$(document).on('click', '#traiterButton3', function (event) {
    event.preventDefault();
    reloadTable_(indexAttenteclientUrl);
});


document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-article')) {
        e.target.closest('.d-flex').remove();
    }
});










$(document).on('click', '#usercentreModal', function (event) {
    event.preventDefault();
    var $this = $(this);
    var dataType = $this.data('type');
    $('#userCentreForm')[0].reset(); // Reset le formulaire
    $('#user_id').prop('disabled', false);
    $('#centre_distrib_ids').prop('disabled', false);
    $('#savebutton').show(); // Affiche le bouton enregistrer
    $('span.text-danger').html(''); // Reset des erreurs

    // Si dataType est égal à 1, on est dans le cas de création
    if (dataType === 1) {
        $('#associerCentreModalTitleLabel').text('Associer Utilisateur et Centres de Distribution');
        $('#userCentreForm').attr('action', userCentrestoreUrl); // URL pour créer l'association
        $('#userCentreForm').attr('method', 'POST'); // Méthode POST pour la création
        $('#associerCentreModal').modal('show'); // Ouvre le modal
        ajaxFormSubmit('serviceForm', userCentrestoreUrl, indexUserCentresUrl, 'POST');
        $('#userCentreForm')[0].reset(); // Reset le formulaire après soumission
        $('#associerCentreModal').modal('hide'); // Ferme le modal
    }
    // Si dataType est égal à 0, on est dans le cas de l'édition
    else if (dataType === 0) {
        var id = $this.data('id');
        var userId = $this.data('user_id');
        var centreDistribIds = $this.data('centre_distrib_ids');
        console.log('centreDistribIds', centreDistribIds);

        var userCentreupdateUrlBaseUrl = userCentreupdateUrlBase.replace('ID', id); // Remplace ID par l'id réel
        $('#associerCentreModalTitleLabel').text('Modifier lien Utilisateur-Centres (ID: ' + id + ')');
        $('#userCentreForm').attr('action', userCentreupdateUrlBaseUrl); // URL pour la mise à jour
        $('#userCentreForm').attr('method', 'POST'); // Méthode POST pour l'édition
        $('#userCentreForm').append('<input type="hidden" name="_method" value="PUT">'); // Pour que Laravel utilise PUT
        $('#user_id').val(userId); // Remplit le champ utilisateur
        $('#centre_distrib_ids').val(centreDistribIds); // Remplit le champ centres
        $('#associerCentreModal').modal('show'); // Ouvre le modal

    }
});








$(document).ready(function() {
    // Écouteur d'événements pour ouvrir le modal et fermer un autre
    $(document).on('click', '#traiterButton2', function(event) {
        event.preventDefault();
        $('#ticketDetailsModalwee').hide();
        $('#ticketTraiterModalwee5').modal('show');
    });

    // Un seul événement pour les boutons #traiterButton3 et #traiterButton4
    $(document).on('click', '#traiterButton3, #traiterButton4', function(event) {
        event.preventDefault(); // Empêcher l'action par défaut du bouton

        var TicketId = document.getElementById('TicketId').value;
        var user_id = document.getElementById('user_id').value;
        var statutId = $(this).attr('id') === 'traiterButton3' ? 3 : 2; // Statut différent selon le bouton


        // Récupérer les articles dynamiques
        var articles = [];
        $('#articlesContainer .d-flex').each(function() {
            var articleId = $(this).find('select[name^="articles"][name$="[ArtId]"]').val();
            var quantity = $(this).find('input[name^="articles"][name$="[quantity]"]').val();
            if (articleId && quantity) {
                articles.push({ ArtId: articleId, quantity: quantity });
            }
        });

        // Récupérer le commentaire
        var Description = $('#Description').val();
        var PanneReelsTypePanneId = document.getElementById('typePanne').value;
        console.log("PanneReelsTypePanneId", PanneReelsTypePanneId);

        // Créer un objet formData avec toutes les informations nécessaires
        var formData = {
            TicketId: TicketId,
            user_id: user_id,
            InterventionStatutId: statutId,
            PanneReelsTypePanneId: PanneReelsTypePanneId,
            articles: articles,
            Description: Description // Ajout du commentaire ici
        };
        console.log(formData);
        ajaxFormSubmitDta(formData, tickettraiterstoreUrl, indexTraiterticketUrl, "POST");
        // Envoi des données via AJAX
       /* $.ajax({
            url: tickettraiterstoreUrl, // URL du contrôleur Laravel
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                alert('Intervention traitée avec succès !');
                $('#ticketTraiterModalwee5').modal('hide');
            },
            error: function(response) {
                if (response.status === 422) { // Code 422 pour les erreurs de validation
                    var errors = response.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(key, value) {
                            alert(value); // Affiche chaque erreur de validation
                        });
                    }
                } else {
                    alert('Une erreur est survenue lors du traitement.');
                }
            }
        });
*/
    });


    function ajaxFormSubmitDta(data, url, url_, method = 'POST') {
        $.ajax({
                url: url,
                type: method,
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function (response) {
                    reloadTable(url_, function () {
                        toastr.success(response.message, 'Succès');
                    });
                    $form[0].reset();
                    $('.modal').modal('hide');
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $('#error-' + key).html(value[0]);
                        });
                    } else {
                        toastr.error('Une erreur est survenue. Veuillez réessayer plus tard.');
                    }
                },
                complete: function () {
                    submitButton.prop('disabled', false).text('Envoyer');
                }
            }
        );
    }

    // Suppression d'un article de la liste dynamique
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-article')) {
            e.target.closest('.d-flex').remove();
        }
    });


    // Gestion de la soumission du formulaire d'intervention
    $('#addInterventionForm').on('submit', function(e) {
        e.preventDefault(); // Empêche la soumission classique du formulaire

        // Récupérer les données du formulaire
        var formData = $(this).serialize();

        // Envoi des données via AJAX (si nécessaire)
        $.ajax({
            url: $(this).attr('action'), // URL du formulaire
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Formulaire soumis avec succès');
                $('#ticketTraiterModalwee5').modal('hide');
            },
            error: function(response) {
                // Gérer les erreurs ici
                console.error('Erreur lors de la soumission du formulaire.');
            }
        });
    });
});


setupConfirmation('#deleteUsercentreModal', {
    title: 'Êtes-vous sûr de vouloir supprimer cette liaison?',
    text: 'Cette action est irréversible.',
    icon: 'warning',
    confirmButtonText: 'Oui, supprimer!',
    cancelButtonText: 'Annuler',
    successTitle: 'Supprimé!',
    successText: 'Le lien a été supprimé.'
}, function () {
}, userCentredeleteUrlBase, indexUserCentresUrl, 'DELETE');
setupConfirmation(
    '#deleteLienUserService',
    {
        title: 'Êtes-vous sûr de vouloir supprimer cette liaison?',
        text: 'Cette action est irréversible.',
        icon: 'warning',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler',
        successTitle: 'Supprimé!',
        successText: 'Le lien a été supprimé.'
    },
    function () {
    }, userservicedeleteUrlBase, indexUserServicesUrl, 'DELETE'
);
setupConfirmation('#deletelienRolePermission', {
    title: 'Êtes-vous sûr de vouloir supprimer cette liaison?',
    text: 'Cette action est irréversible.',
    icon: 'warning',
    confirmButtonText: 'Oui, supprimer!',
    cancelButtonText: 'Annuler',
    successTitle: 'Supprimé!',
    successText: 'Le lien a été supprimé.'
}, function () {
}, rolepermissiondeleteUrlBase, IndexRolePermissionUrl, 'DELETE');

setupConfirmation('#deleteUserModal', {
    title: 'Êtes-vous sûr de vouloir supprimer cet utilisateur?',
    text: 'Cette action est irréversible.',
    icon: 'warning',
    confirmButtonText: 'Oui, supprimer!',
    cancelButtonText: 'Annuler',
    successTitle: 'Supprimé!',
    successText: 'L\'utilisateur a été supprimé.'
}, function () {
    var userId = $('#deleteUserModal').data('id');
    console.log('Utilisateur supprimé avec ID:', userId);

}, deleteUrlBase, indexUserUrl, 'PUT');

setupConfirmation('#deleteRoleModal', {
    title: 'Êtes-vous sûr de vouloir supprimer ce rôle?',
    text: 'Cette action est irréversible.',
    icon: 'warning',
    confirmButtonText: 'Oui, supprimer!',
    cancelButtonText: 'Annuler',
    successTitle: 'Supprimé!',
    successText: 'Le rôle a été supprimé.'
}, function () {
    var roleId = $('#deleteRoleModal').data('id');
    console.log('rôle supprimé avec ID:', roleId);

}, roledeleteUrlBase, indexRolesUrl, 'PUT');


setupConfirmation('#deletePermissionModal', {
    title: 'Êtes-vous sûr de vouloir supprimer cette permission?',
    text: 'Cette action est irréversible.',
    icon: 'warning',
    confirmButtonText: 'Oui, supprimer!',
    cancelButtonText: 'Annuler',
    successTitle: 'Supprimé!',
    successText: 'La permission a été supprimé.'
}, function () {
    var roleId = $('#deletePermissionModal').data('id');
    console.log('permission supprimé avec ID:', roleId);

}, permissiondeleteUrlBase, IndexPermissionsUrl, 'PUT');


setupConfirmation('#deleteServiceModal', {
    title: 'Êtes-vous sûr de vouloir supprimer ce service?',
    text: 'Cette action est irréversible.',
    icon: 'warning',
    confirmButtonText: 'Oui, supprimer!',
    cancelButtonText: 'Annuler',
    successTitle: 'Supprimé!',
    successText: 'Le service a été supprimé.'
}, function () {
    var serviceId = $('#deleteServiceModal').data('id');
    console.log('service supprimé avec ID:', serviceId);

}, servicedeleteUrlBase, indexServicesUrl, 'DELETE');


function ajaxFormSubmit(formId, url, url_, method = 'POST') {
    let $form = $('#' + formId);
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Assurez-vous que l'événement submit n'est attaché qu'une seule fois
    $form.off('submit').on('submit', function (e) {
        e.preventDefault();
        $('span.text-danger').html('');
        let formData = $form.serialize() + `&_token=${csrfToken}`;
        let submitButton = $form.find('button[type="submit"]');
        submitButton.prop('disabled', true).text('Envoi...');

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function (response) {
                reloadTable(url_, function () {
                    toastr.success(response.message, 'Succès');
                });
                $form[0].reset();
                $('.modal').modal('hide');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#error-' + key).html(value[0]);
                    });
                } else {
                    toastr.error('Une erreur est survenue. Veuillez réessayer plus tard.');
                }
            },
            complete: function () {
                submitButton.prop('disabled', false).text('Envoyer');
            }
        });
    });
}

function setupConfirmation(selector, options, onConfirm, url, url_, type) {
    $(document).on('click', selector, function (event) {
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
        success: function (response) {
            reloadTable(url_, function () {
                let swalOptions = localStorage.getItem('swalOptions');
                if (swalOptions) {
                    swalOptions = JSON.parse(swalOptions);
                    Swal.fire(swalOptions.title, swalOptions.text, swalOptions.icon);
                    localStorage.removeItem('swalOptions');
                }
            });
        },
        error: function (xhr) {
            console.error('Une erreur est survenue lors de l\'exécution de l\'action.');
            Swal.fire(
                'Erreur!',
                'Une erreur est survenue. Veuillez réessayer plus tard.',
                'error'
            );
        }
    });

};





function reloadTable_(url_) {
    $.ajax({
        url: url_,
        type: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#body').html(data);
        },
        error: function (xhr) {
            console.error('Une erreur est survenue lors du chargement du tableau.');
        }
    });
}


function reloadTable(url_, callback) {
    $.ajax({
        url: url_,
        type: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#body').html(data);
            if (typeof callback === 'function') {
                callback();
            }
        },
        error: function (xhr) {
            console.error('Une erreur est survenue lors du chargement du tableau.');
        }
    });
}


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

