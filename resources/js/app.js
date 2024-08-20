import './bootstrap';
// Importer Toastr CSS

import 'toastr/build/toastr.min.css';
import Swal from 'sweetalert2';
window.Swal = Swal;
// Importer Toastr JS
import toastr from 'toastr';

// Configurer les options de Toastr
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right", // Position des notifications
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000", // Durée d'affichage
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
