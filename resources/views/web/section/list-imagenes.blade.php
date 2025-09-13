<div class="row d-flex justify-content-center">

    @foreach($imagenes as $imagen)

        <div class="col-lg-6 d-flex align-items-stretch justify-content-center @if($ftco_animate) ftco-animate @endif">
            <div class="blog-entry d-flex row">
                <a href="{{ verImagen($imagen->imagen_path) }}" class="block-20 img col-md-6 image-popup"
                   style="background-image: url('{{ verImagen($imagen->imagen_path) }}');">
                </a>
                <div class="text p-4 bg-light col-md-6">
                    <div class="meta">
                        <p><span class="fa fa-calendar"></span> {{ fechaEnLetras($imagen->fecha, 'D MMMM YYYY') }}</p>
                    </div>
                    <h3 class="heading mb-3"><a>{{ $imagen->titulo }}</a></h3>
                    <p style="min-height: 120px">{{ $imagen->descripcion }}</p>
                </div>
            </div>
        </div>

    @endforeach

</div>
