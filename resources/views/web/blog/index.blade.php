@extends('web.layouts.master')

@section('title', 'Blog')

@section('content')

    @include('web.layouts.hero-wrap-2')

    <section class="ftco-section">
        <livewire:web.blog-component />
    </section>

@endsection
