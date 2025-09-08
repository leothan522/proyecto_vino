@extends('web.layouts.master')

@section('title', 'Mi Cuenta')

@section('content')

    @include('web.layouts.hero-wrap-2')

    @include('web.section.home-section')

@endsection

@section('js')
    <script !src="" type="application/javascript">
        const pedidos = document.querySelector('#div_pedidos');
        const facturacion = document.querySelector('#div_facturacion');

        function verPedidos() {
            pedidos.classList.remove('d-none');
            facturacion.classList.add('d-none');
        }

        function verFacturacion() {
            pedidos.classList.add('d-none');
            facturacion.classList.remove('d-none');
        }

        @if($facturacion)
            verFacturacion();
        @endif

    </script>
@endsection
