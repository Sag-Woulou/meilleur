<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SDC</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
            <link rel="stylesheet" href="{{ asset('style/app.css') }}">
        @yield('stylesheet')
        @yield('style')
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
    @yield('header')
    @yield('content')
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
