<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ing. Yonathan Castillo">
    <meta name="generator" content="Bootstrap v5.3.7">

    <title>@yield('title', 'Morros Devops') - {{ config('app.name', 'Laravel') }}</title>

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

    <!--Bootstrap -->
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
    @vite(['resources/js/bootstrap5.js', 'resources/js/sweetalert2.js', 'resources/js/web-app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">

    <style>
        @media (min-width: 768px) {
            #scale {
                transform: scale(0.8); /* Reduce el tamaño al 80% */
            }
        }

        * {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .text_title {
            color: rgba(8, 23, 44, 1);
            font-weight: bold;
            cursor: pointer;
        }


        .gradient-custom-2 {
            /* fallback for old browsers */
            background: rgb(183, 71, 42);
            /*background: rgb(101, 23, 11);*/

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(90deg,rgba(26, 26, 26, 1) 0%, rgba(183, 71, 42, 1) 0%);
            /*background: -webkit-linear-gradient(90deg,rgba(101, 23, 11, 1) 0%, rgba(174, 59, 46, 1) 100%);*/

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(90deg,rgba(26, 26, 26, 1) 0%, rgba(183, 71, 42, 1) 0%);
            /*background: linear-gradient(90deg,rgba(101, 23, 11, 1) 0%, rgba(174, 59, 46, 1) 100%);*/
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

        /*#preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #fff no-repeat center center;
            z-index: 9999;
        }

        #preloader::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100px;
            height: 100px;
            background: url('{{ asset('img/logo.jpg') }}') no-repeat center center;
            background-size: contain;
            transform: translate(-50%, -50%);
            animation: pulse 2s infinite;
        }*/

        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
            }
        }

        .imagen_top_rigth {
            display: block;
            position: absolute;
            height: 100px;
            width: 100px;
            right: 3%;
            top: 3%;
        }

        #ftco-loader {
            position: fixed;
            width: 96px;
            height: 96px;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9);
            -webkit-box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
            box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
            border-radius: 16px;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: opacity .2s ease-out, visibility 0s linear .2s;
            -o-transition: opacity .2s ease-out, visibility 0s linear .2s;
            transition: opacity .2s ease-out, visibility 0s linear .2s;
            z-index: 1000; }

        #ftco-loader.fullscreen {
            padding: 0;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            -webkit-transform: none;
            -ms-transform: none;
            transform: none;
            background-color: #fff;
            border-radius: 0;
            -webkit-box-shadow: none;
            box-shadow: none; }

        #ftco-loader.show {
            -webkit-transition: opacity .4s ease-out, visibility 0s linear 0s;
            -o-transition: opacity .4s ease-out, visibility 0s linear 0s;
            transition: opacity .4s ease-out, visibility 0s linear 0s;
            visibility: visible;
            opacity: 1; }

        #ftco-loader .circular {
            -webkit-animation: loader-rotate 2s linear infinite;
            animation: loader-rotate 2s linear infinite;
            position: absolute;
            left: calc(50% - 24px);
            top: calc(50% - 24px);
            display: block;
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg); }

        #ftco-loader .path {
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
            -webkit-animation: loader-dash 1.5s ease-in-out infinite;
            animation: loader-dash 1.5s ease-in-out infinite;
            stroke-linecap: round; }

        @-webkit-keyframes loader-rotate {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg); } }

        @keyframes loader-rotate {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg); } }

        @-webkit-keyframes loader-dash {
            0% {
                stroke-dasharray: 1, 200;
                stroke-dashoffset: 0; }
            50% {
                stroke-dasharray: 89, 200;
                stroke-dashoffset: -35px; }
            100% {
                stroke-dasharray: 89, 200;
                stroke-dashoffset: -136px; } }

        @keyframes loader-dash {
            0% {
                stroke-dasharray: 1, 200;
                stroke-dashoffset: 0; }
            50% {
                stroke-dasharray: 89, 200;
                stroke-dashoffset: -35px; }
            100% {
                stroke-dasharray: 89, 200;
                stroke-dashoffset: -136px; } }

    </style>
    {{--<script type="application/javascript">
        //Script para ejecurar el preloader
        window.addEventListener('load', function () {
            document.querySelector('#preloader').style.display = 'none';
            document.querySelector('.container').style.display = 'block';
        });
    </script>--}}

    @livewireStyles
    @yield('css')
</head>
<body class="{{ $publicPage ?? false ? 'public-page' : '' }}" style="background-color: #eee;">

{{--<div id="preloader"></div>--}}

<div class="position-relative gradient-form" style="min-height: 100vh;">
    <div class="position-absolute top-50 start-50 translate-middle container">


        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4 position-relative" id="card_body">

                                <div x-data class="text-center @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'web.index') pt-5 @endif mt-5">
                                    <a id="enlace_hacia_index" href="{{ route('web.index') }}" onclick="verCargandoAuth(this)" @click="window.dispatchEvent(new CustomEvent('showLoader'));">
                                        <img class="img-fluid @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'web.index') mt-sm-5 @endif @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'register') d-none @endif"
                                            src="{{ asset('img/logo.jpg') }}" style="width: 200px !important;"  alt="Logo">
                                    </a>
                                    <h5 class="mt-5 mb-5 pb-1 text_title" onclick="document.getElementById('enlace_hacia_index').click()">
                                        <strong>{{ mb_strtoupper(env('APP_NAME', 'Laravel')) }}</strong>
                                    </h5>
                                </div>

                                @yield('content')

                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex align-items-center gradient-custom-2" style="min-height: 70vh">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4 text-center">
                                <a href="{{ route('web.index') }}">
                                    <img class="img-fluid rounded-2" src="{{ asset('img/logo-nuevo.png') }}" alt="Bodega de vinos artesanal Don juan Espinoza">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- loader -->
<div id="ftco-loader" class="fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
    </svg>
</div>

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>--}}
@livewireScripts
@include('layouts.sweetAlert2')
<script type="application/javascript">
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    form.classList.add('opacity-50');
                    document.querySelector(".verCargando").classList.remove('d-none');
                    const loader = document.getElementById('ftco-loader');
                    if (loader) {
                        loader.classList.add('show');
                    }
                }
                form.classList.add('was-validated');
            }, false);
        })
    })()

    function verCargandoAuth(enlace) {
        event.preventDefault();
        const card = document.querySelector("#card_body");
        const spinner = document.querySelector(".verCargando");

        card.classList.add('opacity-50');
        spinner.classList.remove('d-none');

        setTimeout(function () {
            card.classList.remove('opacity-50');
            spinner.classList.add('d-none');
            //alert(enlace.href)
            window.location.href = enlace.href;
        }, 1000)
    }

    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            // Solo ejecutar si estamos en una vista pública
            if (document.body.classList.contains('public-page')) {
                fetch('{{ route('auth-check') }}', {
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.authenticated) {
                            window.location.href = "{{ route('web.index') }}";
                        }else {
                            // Ocultar el loader si existe
                            const loader = document.getElementById('ftco-loader');
                            if (loader) {
                                loader.classList.remove('show');
                            }
                        }
                    });
            }
        }
    });

    console.log('Hi!')
</script>
@yield('js')
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
