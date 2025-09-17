@extends('web.layouts.master')

@section('title', 'Blog')

@section('content')

    <section class="ftco-section">
        @include('web.layouts.slider-text')
        <livewire:web.blog-component />
    </section>

@endsection
