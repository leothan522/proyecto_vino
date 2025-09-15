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
