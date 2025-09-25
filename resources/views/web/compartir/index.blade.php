@extends('web.layouts.master')

@section('title', 'Compartir APP')

@section('content')

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center pt-3">
                <div class="col-md-12">
                    <div class="wrapper px-md-4">
                        <div class="row no-gutters justify-content-center">

                            <div class="col-md-7">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">Descargar App</h3>
                                    <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                                        <div class="row">
                                            <div class="col-md-6 justify-content-center text-center mb-5">
                                                <a href="{{ route('web.descargar') }}" class="label" for="name">Android</a>
                                                <img class="img-fluid" src="{{ $qrAndroid }}" alt="Codigo QR" />
                                            </div>
                                            <div class="col-md-6 justify-content-center text-center">
                                                <a href="{{ route('web.index') }}" class="label" for="name">IOS</a>
                                                <img class="img-fluid" src="{{ $qrIos }}" alt="Codigo QR" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

{{--@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY', '_GOOGLE_KEY_') }}&sensor=false"></script>
    <script src="{{ asset('vendor/liquorstore/js/google-map.js') }}"></script>
@endsection--}}
