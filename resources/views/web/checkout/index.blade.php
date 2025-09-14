@extends('web.layouts.master')

@section('title', 'Caja')

@section('content')

    @include('web.layouts.hero-wrap-2')

    <section class="ftco-section">
        <livewire:web.checkout-component />
    </section>

@endsection
