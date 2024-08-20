export function ajaxFormSubmit(formId, url, method = 'POST') {
    let $form = $('#' + formId);
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    $form.on('submit', function(e) {
        e.preventDefault();
        $('span.text-danger').html('');
        let formData = $form.serialize();
        console.log("formData",  formData);
        formData += `&_token=${csrfToken}`;

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                console.log('response.message',response.message);
                toastr.success(response.message, 'Succès');
                $('#body').load(window.location.href + '#body');
                $form[0].reset();
                $('.modal').modal('hide');
            },
            error: function(xhr) {
                console.log('xhr', xhr.status);
                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#error-' + key).html(value[0]);
                    });
                } else {
                    toastr.error('Une erreur est survenue. Veuillez réessayer plus tard.');
                }
            }
        });
    });
}
export function setupConfirmation(selector, options, onConfirm, url, type) {
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
                ajaxRequest(userId, url, type);
                Swal.fire(
                    options.successTitle || 'Succès!',
                    options.successText || 'L\'action a été effectuée avec succès.',
                    'success'
                );
            }
        });
    });
}


export function ajaxRequest(userId, url, type) {
    return new Promise((resolve, reject) => {
        console.log("url", deleteUrlBase.replace('USER_ID', userId));
        var deleteUrl = deleteUrlBase.replace('USER_ID', userId);
        $.ajax({
            url: deleteUrl,
            type: type,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                resolve(response);
                console.log('window.location.href',window.location.href);
                $('#body').load(window.location.href + '#body');
            },
            error: function(xhr) {
                reject(xhr);
            }

        });

    });
}
