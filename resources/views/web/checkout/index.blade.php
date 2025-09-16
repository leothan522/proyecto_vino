@extends('web.layouts.master')

@section('title', 'Caja')

@section('content')

    @include('web.layouts.hero-wrap-2')

    <section class="ftco-section">
        <livewire:web.checkout-component
            rowquid="{{ $rowquid }}"
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

@if('js')
    <script>
        function modalPagoMovil() {
            document.getElementById('triggerModalMetodosPagoMovil').click();
        }
        function modalTransferencias() {
            document.getElementById('triggerModalMetodosTransferencias').click();
        }
    </script>
@endif
