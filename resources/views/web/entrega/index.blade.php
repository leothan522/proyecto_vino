@extends('web.layouts.master')

@section('title', 'Contacto')

@section('content')

    <section class="ftco-section bg-light">
        @include('web.layouts.slider-text')
        <livewire:web.entrega-component
            rowquid="{{ $rowquid }}" />
    </section>

@endsection

@section('js')
    <script>

        $('#codigoModal').on('shown.bs.modal', function () {
            document.querySelector('.codigo-input')?.focus();
        });

        $(document).ready(function () {
            window.addEventListener('focus-primer-input', function () {
                $('#codigoModal').find('.codigo-input').first().focus();
            });
        });

        Livewire.on('mostrarAlertaEntrega', () => {
            Swal.fire({
                title: 'Código verificado',
                text: 'Ya puedes proceder a entregar el pedido.',
                icon: 'success',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then(() => {
                document.getElementById('spinner-entrega-pedido').classList.remove('d-none');
                Livewire.dispatch('confirmarEntrega');
            });
        });

    </script>
@endsection
