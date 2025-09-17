@extends('web.layouts.master')

@section('title', 'Acerca de')

@section('content')

    <section class="ftco-section ftco-no-pb">
        @include('web.section.about-section')
    </section>

    <section class="ftco-section d-none d-md-block">
        <livewire:web.tipos-productos-component />
    </section>

    <section class="ftco-section testimony-section img" style="background-image: url({{ asset('img/web/bg_promotores.jpg') }});">
        <div class="overlay"></div>
        <livewire:web.testimony-component />
    </section>

    @include('web.section.counter-section')

@endsection
