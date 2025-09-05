@extends('web.layouts.master')

@section('content')

    @include('web.layouts.hero-wrap-2')

    @include('web.section.contact-section')

@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('vendor/liquorstore/js/google-map.js') }}"></script>
@endsection
