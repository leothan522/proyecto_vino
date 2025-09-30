@extends('web.layouts.master')

@section('title', 'Inicio')

@section('content')

    @include('web.layouts.hero-wrap')

    @include('web.section.intro-section')

    <section class="ftco-section ftco-no-pb d-none d-md-block">
        @include('web.section.about-section')
    </section>

    <section class="ftco-section ftco-no-pb d-md-none">
        <div class="row justify-content-center pb-3 pt-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">UPF Bodega de Vinos Artesanal</span>
                <h2>Don Juan Espinoza</h2>
            </div>
            <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center"
                 style="background-image: url({{ asset('img/logo-nuevo.png') }});background-size: contain;background-position: center;background-repeat: no-repeat;">
            </div>
        </div>
    </section>

    <div class="d-md-none">
        @include('web.section.division-section')
    </div>

    <section class="ftco-section ftco-no-pb d-none d-md-block">
        <livewire:web.tipos-productos-component/>
    </section>

    <section class="ftco-section">
        <livewire:web.recent-products-component/>
        <livewire:web.modal-login-component/>
    </section>

    <div class="d-none d-md-block">
        @include('web.section.division-section')
    </div>

    <section class="ftco-section d-none d-md-block">
        <livewire:web.recent-blog-component />
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
@endsection
