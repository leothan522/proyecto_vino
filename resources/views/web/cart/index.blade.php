@extends('web.layouts.master')

@section('title', 'Mi Carrito')

@section('content')

    <section class="ftco-section bg-light">
        @include('web.layouts.slider-text')
        <livewire:web.cart-component />
        <livewire:web.modal-login-component/>
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
    @include('web.section.scripts-list-product')
    <script !src="" type="application/javascript">

        Livewire.on('procesarPedido', () => {
            document.getElementById('boton_procesar_pedido').click();
        });

        Livewire.on('setCantidad', ({ cantidad, id, original}) => {
            let input = document.querySelector('#input_cantidad_item_' + id);
            if (cantidad < 0){
                input.value = original;
            }
        });

    </script>
@endsection
