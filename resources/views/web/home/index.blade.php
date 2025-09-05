@extends('web.layouts.master')

@section('content')

    @include('web.layouts.hero-wrap')

    @include('web.section.intro-section')

    <section class="ftco-section ftco-no-pb">
        @include('web.section.about-section')
    </section>

    <section class="ftco-section ftco-no-pb">
        @include('web.section.list-types-section')
    </section>

    @include('web.section.recent-products-section')

    @include('web.section.testimony-section')

    @include('web.section.recent-blog-section')

@endsection
