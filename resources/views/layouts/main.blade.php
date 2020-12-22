<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Nunito';
        }
        #logo {
            width: 3em;
            height: 2rem;
        }
        ul {
            list-style-type: none;
        }
        .half_banners, .welcome_banners {
            font-size: 4rem;
            min-height: 13rem;
        }

        .text_breaks {
            font-size: 2rem;
        }

        .category:hover, .brand:hover {
            border: 1px solid darkgreen;
        }

        @yield('style')
    </style>

@livewireStyles

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
@livewire('navigation-dropdown')
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
