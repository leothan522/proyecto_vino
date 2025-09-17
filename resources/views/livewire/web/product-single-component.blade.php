<div class="container">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="row">

        {{--Imagen del producto--}}
        <div class="col-lg-6 mb-5 @if($ftco_animate) ftco-animate @endif">
            <a href="{{ verImagen($imagen) }}" class="image-popup prod-img-bg">
                <img src="{{ verImagen($imagen) }}" class="img-fluid" alt="Colorlib Template">
            </a>
        </div>

        {{--Datos del producto--}}
        <div class="col-lg-6 product-details pl-md-5 @if($ftco_animate) ftco-animate @endif">

            {{--Nombre--}}
            <h3>{{ $nombre }}</h3>

            {{--Tipo--}}
            <div class="rating d-flex">
                <p class="text-left mr-4">
                    <a href="#" wire:click.prevent="showTiposProductos" class="mr-2">{{ $tipo }}</a>
                </p>
            </div>

            {{--Bodega y cantidad de vendidos--}}
            <div class="rating d-flex">
                <p class="text-left mr-4">
                    <a href="#" wire:click.prevent="showAlmacen" class="mr-2">{{ $almacen }}</a>
                </p>
                <p class="text-left">
                    <a href="#" onclick="return false" class="mr-2 @if(!$vendidos) d-none @endif" style="color: #000; cursor: text;">{{ $vendidos }} <span style="color: #bbb;">Vendido(s)</span></a>
                </p>
            </div>

            {{-- Precio --}}
            <p class="price"><span>BCV ${{ $precio }}</span></p>

            {{--Descripcion--}}
            <p>{{ $descripcion }}</p>

            {{--Botones Cantidad--}}
            <div class="row mt-4">
                <div class="input-group col-md-6 d-flex mb-3 position-relative">

                    {{-- Boton Menos--}}
                    <span class="input-group-btn mr-2">
                        <button x-on:click="$wire.cantidad == 1 ? $wire.cantidad = 1 : $wire.cantidad--" type="button" class="btn" data-type="minus" data-field="">
                            <i class="fa fa-minus"></i>
                        </button>
                    </span>

                    {{--Input Cantidad--}}
                    <input wire:model="cantidad" type="number" name="quantity" class="quantity form-control input-number" min="1" max="100">

                    {{--Boton Mas--}}
                    <span class="input-group-btn ml-2">
                        <button x-on:click="$wire.cantidad < $wire.max ? $wire.cantidad++ : $wire.cantidad = $wire.max" type="button" class="btn" @if(!$max) disabled @endif>
                         <i class="fa fa-plus"></i>
                        </button>
                    </span>

                    <!-- Spinner overlay -->
                    <div wire:loading wire:target="addCart, showCart, showTiposProductos, showAlmacen" class="spinner-overlay align-content-center text-center">
                        <div class="spinner-border color-active" role="status"></div>
                    </div>

                </div>

                {{--Separador--}}
                <div class="w-100"></div>

                {{--Stock Disponible--}}
                <div class="col-md-12">
                    <p style="color: #000;">{{ $disponibles }} piezas disponibles</p>
                </div>

            </div>

            {{--Botones del Carrito--}}
            <p class="d-flex">
                <a href="#" wire:click.prevent="addCart" class="btn btn-primary py-3 px-5 mr-2 mt-2" wire:loading.class="disabled" wire:target="show">
                    Añadir al Carrito
                </a>
                <a href="#" wire:click.prevent="showCart" class="btn btn-primary py-3 px-5 mt-2" wire:loading.class="disabled" wire:target="irCart">
                    Comprar Ahora
                </a>
            </p>

        </div>

    </div>

</div>
