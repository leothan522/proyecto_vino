@extends('web.layouts.master')

@section('title', 'Mi Cuenta')

@section('content')

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row pt-3" x-data="{ cargando: false }">

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

@section('css')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Para Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
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

        function verSpinnerCargando() {
            const loader = document.getElementById('ftco-loader');
            if (loader) {
                loader.classList.add('show');
            }
        }

        @if(session()->has('menu_home'))
            verFacturacion();
        @else
             verPedidos();
        @endif

        Livewire.on('buttonModalPedidos', () => {
            document.getElementById('buttonModalPedidos').click();
        });

        Livewire.on('initModalShow', () => {
            document.getElementById('buttonModalShowCliente').click();
        });

        document.getElementById('btnDescartarPedido').addEventListener('click', function () {
            Swal.fire({
                title: '¿Descartar pedido?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, descartar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí va la lógica para descartar el pedido
                    // Por ejemplo: enviar solicitud al backend o redirigir
                    document.getElementById('spinner_eliminar_pedido').classList.remove('d-none');
                    document.getElementById('cerrarModalLoginFast').click();
                    Livewire.dispatch('delete');
                    Swal.fire({
                        title: 'Pedido descartado',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });


    </script>
@endsection
