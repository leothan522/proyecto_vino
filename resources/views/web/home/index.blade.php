@extends('web.layouts.master')

@section('title', 'Mi Cuenta')

@section('content')

    @include('web.layouts.hero-wrap-2')

    <section class="ftco-section">
        <div class="container">
            <div class="row" x-data="{ cargando: false }">

                {{--Content home--}}
                <div class="col-md-10 order-last position-relative">

                    {{--Mis Pedidos--}}
                    <livewire:web.home-pedidos-component />

                    {{--Datos Facturacion--}}
                    <livewire:web.home-datos-component />

                    <!-- Spinner overlay -->
                    <div x-show="cargando" class="spinner-overlay align-content-center">
                        <div class="spinner-border color-active" role="status"></div>
                    </div>

                </div>

                {{--Menu Home--}}
                <livewire:web.home-menu-component />

            </div>
        </div>
    </section>

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

        @if(session()->has('menu_home'))
            verFacturacion();
        @else
             verPedidos();
        @endif

        Livewire.on('buttonModalPedidos', () => {
            document.getElementById('buttonModalPedidos').click();
        });

    </script>
@endsection
