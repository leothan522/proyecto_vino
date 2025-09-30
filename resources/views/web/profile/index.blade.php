@extends('web.layouts.master')

@section('title', 'Mi Cuenta')

@section('content')

    @include('web.section.profile-section')

@endsection

@section('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('js')
    <script !src="">
        function verPedidos() {
            verSpinnerCargando();
        }

        function verFacturacion() {
            verSpinnerCargando();
        }

        function verSpinnerCargando() {
            const loader = document.getElementById('ftco-loader');
            if (loader) {
                loader.classList.add('show');
            }
        }
    </script>
@endsection
