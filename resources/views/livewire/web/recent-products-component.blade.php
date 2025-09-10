<div class="container">
    {{-- Because she competes with no one, no one can compete with her. --}}

    @if($almacenes_id)

        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center @if($ftco_animate) ftco-animate @endif">
                <span class="subheading">Nuestras Deliciosas Ofertas en</span>
                <h2>{{ $almacen }}</h2>
            </div>
        </div>

        @if($productos->isNotEmpty())
            <div class="row justify-content-center">

                @foreach($productos as $producto)

                    {{--Normal--}}
                    <div class="col-md-3 d-flex">
                        <div class="product position-relative @if($ftco_animate) ftco-animate @endif">
                            <div class="img d-flex align-items-center justify-content-center"
                                 style="background-image: url({{ verImagen($producto->imagen_path) }});">
                                <div class="desc">
                                    <p class="meta-prod d-flex">
                                        <a href="#" class="d-flex align-items-center justify-content-center"><span class="flaticon-shopping-bag"></span></a>
                                        <a href="#" class="d-flex align-items-center justify-content-center"><span class="flaticon-heart"></span></a>
                                        <a href="#" wire:click.prevent="show({{ $producto->id }})" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
                                    </p>
                                </div>
                            </div>
                            <div class="text text-center">
                                <span class="category">{{ $producto->tipo->nombre }}</span>
                                <h2>{{ $producto->nombre }}</h2>
                                <span class="price">${{ formatoMillares($producto->precio) }}</span>
                            </div>
                            <!-- Spinner overlay -->
                            <div wire:loading wire:target="show({{ $producto->id }})" class="spinner-overlay align-content-center text-center">
                                <div class="spinner-border color-active" role="status"></div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="{{ route('web.products') }}" class="btn btn-primary d-block">Ver Todos los Productos <span
                        class="fa fa-long-arrow-right"></span></a>
            </div>
        </div>

    @endif

</div>
