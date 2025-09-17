<div class="row justify-content-center">

    @foreach($productos as $producto)

        {{--Normal--}}
        <div class="col-md-{{ $col }} d-flex">
            <div class="product position-relative @if($ftco_animate) ftco-animate @endif">
                <div class="img d-flex align-items-center justify-content-center"
                     style="background-image: url({{ verImagen($producto->imagen_path) }});">
                    <div class="desc">
                        <p class="meta-prod d-flex">
                            <a href="#" wire:click.prevent="productAddCart({{ $producto->id }})" class="d-flex align-items-center justify-content-center">
                                @if($this->productInCart($producto->id))
                                    <span class="fa fa-shopping-bag text-warning"></span>
                                @else
                                    <span class="flaticon-shopping-bag"></span>
                                @endif
                            </a>
                            <a href="#" wire:click.prevent="productAddFavorite({{ $producto->id }})" class="d-flex align-items-center justify-content-center">
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
                <div wire:loading wire:target="productShow({{ $producto->id }})" class="spinner-overlay align-content-center text-center">
                    <div class="spinner-border color-active" role="status"></div>
                </div>
                <div wire:loading wire:target="productAddFavorite({{ $producto->id }})" class="spinner-overlay align-content-center text-center">
                    <div class="spinner-border color-active" role="status"></div>
                </div>
                <div wire:loading wire:target="productAddCart({{ $producto->id }})" class="spinner-overlay align-content-center text-center">
                    <div class="spinner-border color-active" role="status"></div>
                </div>
            </div>
        </div>

    @endforeach

</div>
