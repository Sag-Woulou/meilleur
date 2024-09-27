<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GES-TICKET</title>




    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/topnavbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/app.js')
</head>
<body id="body">
@yield('content')
<footer class="footer">
    <div class="container-fluid">
        <div class="footer-in">
            <p class="mb-0">&copy 2024 Shi'k Design. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script>
    var indexUserUrl = "{{ route('users.index') }}";
    var storeUrl = "{{ route('users.store') }}";
    var updateUrlBase = "{{ route('users.update', ['user' => 'ID']) }}";
    var deleteUrlBase = "{{ route('users.updateDeleted', ['user' => 'ID']) }}";
    var listeUrl = "{{ route('admin.index') }}";

    var indexRolesUrl = "{{ route('roles.index') }}";
    var rolestoreUrl = "{{ route('roles.store') }}";
    var roleupdateUrlBase = "{{ route('roles.update', ['role' => 'ID']) }}";
    var roledeleteUrlBase = "{{ route('roles.updateDeleted', ['role' => 'ID']) }}";
    var rolelisteUrl = "{{ route('admin.index') }}";

    var IndexPermissionsUrl = "{{ route('permissions.index') }}";
    var permissionstoreUrl = "{{ route('permissions.store') }}";
    var permissionupdateUrlBase = "{{ route('permissions.update', ['permission' => 'ID']) }}";
    var permissiondeleteUrlBase = "{{ route('permissions.updateDeleted', ['permission' => 'ID']) }}";
    var permissionlisteUrl = "{{ route('admin.index') }}";

    var IndexRolePermissionUrl = "{{ route('rolelier.index') }}";
    var rolepermissionstoreUrl = "{{ route('rolelier.store') }}";  // Utilisation correcte de la route pour le stockage
    var rolepermissiondeleteUrlBase = "{{ route('rolelier.updateDeleted', ['role' => 'ID']) }}";
    var rolepermissionupdateUrlBase = "{{ route('rolelier.update', ['rolelier' => 'ID']) }}";

    var indexServicesUrl = "{{ route('services.index') }}";
    var servicestoreUrl = "{{ route('services.store') }}";
    var serviceupdateUrlBase = "{{ route('services.update', ['service' => 'ID']) }}";
    var servicedeleteUrlBase = "{{ route('services.updateDeleted', ['service' => 'ID']) }}";
    var servicelisteUrl = "{{ route('admin.index') }}";

    var indexUserServicesUrl = "{{ route('userservice.index') }}";
    var userservicestoreUrl = "{{ route('userservice.store') }}";
    var userserviceupdateUrlBase = "{{ route('userservice.update', ['userservice' => 'ID']) }}";
    var userservicedeleteUrlBase = "{{ route('userservice.updateDeleted', ['user' => 'ID']) }}";

    var indexUserCentresUrl = "{{ route('usercentre.index') }}";
    var userCentrestoreUrl = "{{ route('usercentre.store') }}";
    var userCentreupdateUrlBase = "{{ route('usercentre.update', ['usercentre' => 'ID']) }}";
    var userCentredeleteUrlBase = "{{ route('usercentre.updateDeleted', ['user' => 'ID']) }}";

    var indexTransfertUrl="{{route('transferticket.index')}}";
    var updateTicketUrl = "{{ route('transferticket.updatedTicket', ['transferticket' => 'ID']) }}";

    var indexTraiterticketUrl="{{route('traiterticket.index')}}";
    var indexticketcloturerUrl="{{route('ticketcloturer.index')}}";
    var indexAttenteclientUrl="{{route('attenteclient.index')}}"
    var traiterstoreUrl = "{{ route('traiterticket.store') }}";


    var ticketUrl = "{{ route('traiterticket.show', ':id') }}";

</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script type="module" src="{{ asset('requests/user.js') }}"></script>
</body>
</html>
