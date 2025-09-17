@extends('web.layouts.master')

@section('title', 'Ver Producto')

@section('content')

    <section class="ftco-section">
        <livewire:web.product-single-component
            productos_id="{{ $productos_id }}"
        />
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
