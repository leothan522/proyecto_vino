@extends('web.layouts.master')

@section('title', 'Inicio')

@section('content')

    @include('web.layouts.hero-wrap')

    @include('web.section.intro-section')

    <section class="ftco-section ftco-no-pb d-none d-md-block">
        @include('web.section.about-section')
    </section>

    <section class="ftco-section ftco-no-pb d-none d-md-block">
        <livewire:web.tipos-productos-component/>
    </section>

    <section class="ftco-section">
        <livewire:web.recent-products-component/>
        <livewire:web.modal-login-component/>
    </section>

    <section class="ftco-section testimony-section img" style="background-image: url({{ asset('img/web/bg_promotores.jpg') }});">
        <div class="overlay"></div>
        {{--<livewire:web.testimony-component/>--}}
    </section>

    <section class="ftco-section d-none d-md-block">
        <livewire:web.recent-blog-component />
    </section>

@endsection

@section('js')
    @include('web.section.scripts-list-product')
@endsection
