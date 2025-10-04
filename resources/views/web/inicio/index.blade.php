@extends('web.layouts.master')

@section('title', 'Inicio')

@section('content')

    @include('web.layouts.hero-wrap')

    @include('web.section.intro-section')

    <section class="ftco-section ftco-no-pb d-none d-md-block">
        @include('web.section.about-section')
    </section>

    <section class="ftco-section ftco-no-pb d-md-none">
        <div class="container">
            <div class="row justify-content-center pb-3 pt-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">UPF Bodega de Vinos Artesanal</span>
                    <h2>Don Juan Espinoza</h2>
                </div>
                <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center ftco-animate"
                     style="background-image: url({{ asset('img/logo-nuevo.png') }});background-size: contain;background-position: center;background-repeat: no-repeat;">
                </div>
            </div>
        </div>
    </section>

    <div class="d-md-none">
        @include('web.section.division-section')
    </div>

    <section class="ftco-intro ftco-animate mt-5 d-md-none">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="intro color-2 d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-free-delivery"></span>
                        </div>
                        <div class="text">
                            <h2>Envío Gratis</h2>
                            <p>Los envios dentro del municipio no tienen consto adicional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
