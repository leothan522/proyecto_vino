@extends('web.layouts.master')

@section('title', 'Productos')

@section('content')

    @include('web.layouts.hero-wrap-2')

    <section class="ftco-section">
        <livewire:web.products-component />
        <livewire:web.modal-login-component/>
    </section>

@endsection

@section('js')
    @include('web.section.scripts-list-product')
    <script type="application/javascript">

        function setSelectFiltro() {
            alert('hola');
        }

    </script>
@endsection
