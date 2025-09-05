@extends('web.layouts.master')

@section('content')

    @include('web.layouts.hero-wrap-2')

    @include('web.section.contact-section')

@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY', '_GOOGLE_KEY_') }}&sensor=false"></script>
    <script src="{{ asset('vendor/liquorstore/js/google-map.js') }}"></script>
@endsection
