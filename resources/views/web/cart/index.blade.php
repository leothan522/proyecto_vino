@extends('web.layouts.master')

@section('title', 'Mi Carrito')

@section('content')

    @include('web.layouts.hero-wrap-2')

    <section class="ftco-section">
        <livewire:web.cart-component />
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
        Livewire.on('setCantidad', ({ cantidad, id, original}) => {
            let input = document.querySelector('#input_cantidad_item_' + id);
            if (cantidad < 0){
                input.value = original;
            }
        });
    </script>
@endsection
