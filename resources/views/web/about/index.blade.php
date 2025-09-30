@extends('web.layouts.master')

@section('title', 'Acerca de')

@section('content')

    <section class="ftco-section ftco-no-pb">
        @include('web.section.about-section')
    </section>

    <section class="ftco-section d-none d-md-block">
        <livewire:web.tipos-productos-component />
    </section>

    <div>
        @include('web.section.division-section')
    </div>

    @include('web.section.counter-section')

@endsection
