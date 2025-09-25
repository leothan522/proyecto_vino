@extends('web.layouts.master')

@section('title', 'Compartir APP')

@section('content')

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center pt-3">
                <div class="col-md-12">
                    <div class="wrapper px-md-4">
                        <div class="row no-gutters justify-content-center">

                            <div class="col-md-7 mb-4">
                                <div class="contact-wrap w-100 p-4">
                                    <h3 class="mb-4">Descargar App</h3>
                                    <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                                        <div class="row">
                                            <div x-data="{ cargando: false }" class="col-md-6 justify-content-center text-center mb-3 mb-md-auto">
                                                <label class="label">Android</label>
                                                <img class="img-fluid" src="{{ $qrAndroid }}" alt="Codigo QR" />
                                                <a @click="cargando = true; setTimeout(() => cargando = false, 3000);" href="{{ route('web.descargar') }}" class="label" style="text-decoration: underline;">
                                                    <i class="fa fa-cloud-download" aria-hidden="true"></i> Descargar
                                                </a>
                                                <div x-show="cargando" class="spinner-overlay align-content-center">
                                                    <div class="spinner-border color-active" role="status"></div>
                                                </div>
                                            </div>
                                            <div x-data="{ cargando: false }" class="col-md-6 justify-content-center text-center mt-5 mt-md-auto">
                                                <label class="label">IOS</label>
                                                <img class="img-fluid" src="{{ $qrIos }}" alt="Codigo QR" />
                                                <a @click="cargando = true" href="{{ route('web.index') }}" class="label" style="text-decoration: underline;">
                                                    <i class="fa fa-external-link-square" aria-hidden="true"></i> Abrir
                                                </a>
                                                <div x-show="cargando" class="spinner-overlay align-content-center">
                                                    <div class="spinner-border color-active" role="status"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="dbox w-100">
                                    <div class="text text-center">
                                        <p><span class="color-active">Instalación directa en iPhone desde Safari:</span></p>
                                    </div>
                                    <div class="text">
                                        <p class="font-weight-bold">1. Abre el enlace del código QR para <span class="color-active">IOS</span> en Safari.</p>
                                        <p class="font-weight-bold">2. - Toca “Compartir” → “Agregar a pantalla de inicio”.</p>
                                        <p class="font-weight-bold">3. - Se instala la app y listo.</p>
                                    </div>
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
