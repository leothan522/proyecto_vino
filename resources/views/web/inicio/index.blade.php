@extends('web.layouts.master')

@section('title', 'Inicio')

@section('content')

    @include('web.layouts.hero-wrap')

    @include('web.section.intro-section')

    <section class="ftco-section ftco-no-pb">
        @include('web.section.about-section')
    </section>

    <section class="ftco-section ftco-no-pb">
        <livewire:web.tipos-productos-component/>
    </section>

    <section class="ftco-section">
        <livewire:web.recent-products-component />
    </section>

    @include('web.section.testimony-section')

    @include('web.section.recent-blog-section')

@endsection
