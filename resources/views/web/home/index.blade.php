@extends('web.layouts.master')

@section('title', 'Mi Cuenta')

@section('content')

    @include('web.layouts.hero-wrap-2')

    @include('web.section.home-section')

@endsection

@section('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('js')
    <script !src="" type="application/javascript">
        const profile = document.querySelector('#div_profile');
        const pedidos = document.querySelector('#div_pedidos');
        const facturacion = document.querySelector('#div_facturacion');

        function verPedidos() {
            profile.classList.add('d-none');
            pedidos.classList.remove('d-none');
            facturacion.classList.add('d-none');
        }

        function verFacturacion() {
            profile.classList.add('d-none');
            pedidos.classList.add('d-none');
            facturacion.classList.remove('d-none');
        }

        function verProfile() {
            profile.classList.remove('d-none');
            pedidos.classList.add('d-none');
            facturacion.classList.add('d-none');
        }

        @if($verPedidos)
            verPedidos();
        @endif

    </script>
@endsection
