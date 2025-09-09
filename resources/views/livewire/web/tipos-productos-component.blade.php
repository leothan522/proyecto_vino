<div class="container">
    {{-- In work, do what you enjoy. --}}
    @if($tiposProductos->isNotEmpty())
        <div class="row justify-content-center">
            @foreach($tiposProductos as $tipo)

                <div class="col-lg-2 col-md-4">
                    <div class="sort w-100 text-center position-relative @if($ftco_animate) ftco-animate @endif">
                        <div class="img" wire:click="show({{ $tipo->id }})"
                             style="background-image: url({{ verImagen($tipo->imagen_path) }}); cursor: pointer">
                        </div>
                        <h3 style="cursor: pointer" wire:click="show({{ $tipo->id }})">{{ $tipo->nombre }}</h3>
                        <!-- Spinner overlay -->
                        <div wire:loading wire:target="show({{ $tipo->id }})"
                             class="spinner-overlay align-content-center">
                            <div class="spinner-border color-active" role="status"></div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @endif
</div>
