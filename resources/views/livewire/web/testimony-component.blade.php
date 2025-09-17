<div class="container">
    {{-- Be like water. --}}

    @if($promotores->isNotEmpty())

        <div class="row justify-content-center mb-5">
            <div
                class="col-md-7 text-center heading-section heading-section-white @if($ftco_animate) ftco-animate @endif">
                <h2 class="mb-3">Promotores de Ventas</h2>
            </div>
        </div>

        <div class="row @if($ftco_animate) ftco-animate @endif">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">

                    @foreach($promotores as $promotor)
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                <div class="text">
                                    <div class="d-flex align-items-center">
                                        <div class="user-img"
                                             style="background-image: url({{ verImagen($promotor->user->imagen_path, true) }})"></div>
                                        <div class="pl-3">
                                            <p class="name">{{ $promotor->user->name }}</p>
                                            <span class="position">{{ $promotor->almacen->nombre }}</span><br>
                                            <a href="tel:{{ Str::replace([' ', '-'], '', $promotor->user->telefono) }}" class="position">{{ $promotor->user->telefono }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    @endif

</div>
