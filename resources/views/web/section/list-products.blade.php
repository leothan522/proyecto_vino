<div class="row justify-content-center">

    @foreach($productos as $producto)

        {{--Normal--}}
        <div class="col-md-{{ $col }} d-flex">
            <div class="product position-relative @if($ftco_animate) ftco-animate @endif">
                <div class="img d-flex align-items-center justify-content-center" style="background-image: url({{ verImagen($producto->imagen_path) }});">
                    <div class="desc">
                        <p class="meta-prod d-flex">
                            <a href="#" wire:click.prevent="productAddCart({{ $producto->id }})"
                               class="d-none d-md-flex align-items-center justify-content-center">
                                @if($this->productInCart($producto->id))
                                    <span class="fa fa-shopping-bag text-warning"></span>
                                @else
                                    <span class="flaticon-shopping-bag"></span>
                                @endif
                            </a>
                            <a href="#" wire:click.prevent="productAddFavorite({{ $producto->id }})"
                               class="d-flex align-items-center justify-content-center">
                                @if($this->productIsFavorite($producto->id))
                                    <span class="fa fa-heart text-danger"></span>
                                @else
                                    <span class="fa fa-heart-o"></span>
                                @endif
                            </a>
                            <button id="buttonModalLoginFast_{{ $producto->id }}" type="button" class="d-none" data-toggle="modal" data-target="#modalLoginFast">Modal Login Fast</button>
                            <a href="#" wire:click.prevent="productShow({{ $producto->id }})" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
                        </p>
                    </div>
                </div>
                <div class="text text-center">
                    <span class="category">{{ $producto->tipo->nombre }}</span>
                    @if($this->productIsAgotado($producto->id))
                        <span class="sale">Agotado</span>
                    @endif
                    <h2>{{ $producto->nombre }}</h2>
                    <span class="price">BCV ${{ formatoMillares($producto->precio) }}</span>
                </div>

                <!-- Spinner overlay -->
                <div wire:loading wire:target="productShow({{ $producto->id }})"
                     class="spinner-overlay align-content-center text-center">
                    <div class="spinner-border color-active" role="status"></div>
                </div>
                <div wire:loading wire:target="productAddFavorite({{ $producto->id }})"
                     class="spinner-overlay align-content-center text-center">
                    <div class="spinner-border color-active" role="status"></div>
                </div>
                <div wire:loading wire:target="productAddCart({{ $producto->id }})"
                     class="spinner-overlay align-content-center text-center">
                    <div class="spinner-border color-active" role="status"></div>
                </div>

                @if(!$this->productIsAgotado($producto->id))

                    <div class="col-12 product-details d-md-none p-0">

                        {{--Botones Cantidad--}}
                        <div class="row">
                            <div class="input-group col-md-6 d-flex mb-3 position-relative">

                                {{-- Boton Menos--}}
                                <span class="input-group-btn mr-2">
                                    <button x-on:click="$wire.cantidadCarrito[{{ $producto->id }}] == 1 ? $wire.cantidadCarrito[{{ $producto->id }}] = 1 : $wire.cantidadCarrito[{{ $producto->id }}]--" type="button"
                                            class="btn" data-type="minus" data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </span>

                                {{--Input Cantidad--}}
                                <input type="number"  wire:model="cantidadCarrito.{{ $producto->id }}" class="quantity form-control input-number" min="1">

                                {{--Boton Mas--}}
                                <span class="input-group-btn ml-2">
                                    <button x-on:click="$wire.cantidadCarrito[{{ $producto->id }}] < $wire.maxCarrito[{{ $producto->id }}] ? $wire.cantidadCarrito[{{ $producto->id }}]++ : $wire.cantidadCarrito[{{ $producto->id }}] = $wire.maxCarrito[{{ $producto->id }}]" type="button" class="btn"{{-- @if(!$max) disabled @endif--}}>
                                     <i class="fa fa-plus"></i>
                                    </button>
                                </span>

                                <!-- Spinner overlay -->
                                <div wire:loading wire:target="addCartItem({{ $producto->id }})" class="spinner-overlay align-content-center text-center">
                                    <div class="spinner-border color-active" role="status"></div>
                                </div>

                                <!-- Spinner overlay -->
                                <div wire:loading wire:target="showCartItem({{ $producto->id }})" class="spinner-overlay align-content-center text-center">
                                    <div class="spinner-border color-active" role="status"></div>
                                </div>

                            </div>
                        </div>

                        {{--Botones del Carrito--}}
                        <p class="d-flex">
                            <a href="#" wire:click.prevent="addCartItem({{ $producto->id }})" class="btn btn-primary py-3 px-5 mr-2 mt-2"
                               wire:loading.class="disabled" wire:target="show">
                                Añadir al Carrito
                            </a>
                            <a href="#" wire:click.prevent="showCartItem({{ $producto->id }})" class="btn btn-primary py-3 px-5 mt-2"
                               wire:loading.class="disabled" wire:target="irCart">
                                Comprar Ahora
                            </a>
                        </p>

                    </div>

                @endif

            </div>



        </div>

    @endforeach

</div>
