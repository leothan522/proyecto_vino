@extends('web.layouts.master')

@section('title', 'Mi Carrito')

@section('content')

    @include('web.layouts.hero-wrap-2')

    <section class="ftco-section">
        @include('web.section.cart-section')
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
