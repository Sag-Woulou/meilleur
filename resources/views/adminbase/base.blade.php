<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
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
            <p class="mb-0">&copy 2021 Vishweb Design. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
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
</script>
<script type="module" src="{{ asset('requests/user.js') }}"></script>
</body>
</html>
