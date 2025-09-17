@extends('web.layouts.master')

@section('title', 'Contacto')

@section('content')

    <section class="ftco-section bg-light">
        <livewire:web.contact-component />
    </section>

@endsection

{{--@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY', '_GOOGLE_KEY_') }}&sensor=false"></script>
    <script src="{{ asset('vendor/liquorstore/js/google-map.js') }}"></script>
@endsection--}}
