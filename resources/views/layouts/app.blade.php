<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Bienvenido') - {{ config('app.name', 'Laravel') }}</title>

        <!-- Favicons -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/appicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/appicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicons/appicon-48x48.png') }}">
        <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicons/appicon-64x64.png') }}">
        <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicons/appicon-128x128.png') }}">
        <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('favicons/appicon-256x256.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('favicons/appicon-256x256.png') }}">
        <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
        <meta name="theme-color" content="#ffffff">

        <!-- Android -->
        <meta name="mobile-web-app-capable" content="yes">

        <!-- iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="Juan Espinoza">
        <link rel="apple-touch-icon" href="{{ asset('favicons/appicon-256x256.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/sweetalert2.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        @include('layouts.sweetAlert2')
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('{{ asset('pwabuilder-sw.js') }}')
                        .then(reg => console.log('SW registrado:', reg.scope))
                        .catch(err => console.error('Error al registrar SW:', err));
                });
            }
        </script>
    </body>
</html>
