@extends('web.layouts.master')

@section('title', 'Mi Cuenta')

@section('content')

    @include('web.layouts.hero-wrap-2')

    @include('web.section.profile-section')

@endsection

@section('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection
