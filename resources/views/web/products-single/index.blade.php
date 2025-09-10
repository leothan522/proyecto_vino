@extends('web.layouts.master')

@section('title', 'Ver Producto')

@section('content')

    @include('web.layouts.hero-wrap-2')

    <section class="ftco-section">
        <livewire:web.product-single-component
            productos_id="{{ $productos_id }}"
        />
    </section>

@endsection
