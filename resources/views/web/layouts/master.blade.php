<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', 'Bienvenido') - {{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/appicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/appicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicons/appicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicons/appicon-64x64.png') }}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicons/appicon-128x128.png') }}">
    <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('favicons/appicon-256x256.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicons/appicon-256x256.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Android -->
    <meta name="mobile-web-app-capable" content="yes">

    <!-- iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Juan Espinoza">
    <link rel="apple-touch-icon" href="{{ asset('favicons/appicon-256x256.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/liquorstore/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/liquorstore/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/liquorstore/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/liquorstore/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/liquorstore/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/liquorstore/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/liquorstore/css/bootstrap/bootstrap-select.css') }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/sweetalert2.js', 'resources/js/web-app.js'])
    @endif

    <link rel="stylesheet" href="{{ asset('css/web/style.css') }}">

    @livewireStyles
    @yield('css')
</head>
<body>

{{--@include('web.layouts.header')--}}

@include('web.layouts.navbar')

@yield('content')

@include('web.layouts.footer')

<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
    </svg>
</div>

<script src="{{ asset('vendor/liquorstore/js/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/popper.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/scrollax.min.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('vendor/liquorstore/js/main.js') }}"></script>

@include('layouts.sweetAlert2')
@livewireScripts
@yield('js')
<script>
    $('.image-popup-individual').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        gallery: {
            enabled: false,
        },
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });
</script>
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
