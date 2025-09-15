<div class="container" x-data="{ cargando: false }">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    {{--Tabla Los Productos--}}
    @if($items->isNotEmpty())

        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-primary">
                    <tr>
                        <th>&nbsp;</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody class="position-relative">

                    @foreach($items as $item)

                        <tr class="alert" role="alert">
                            <td>
                                <div class="img"
                                     style="background-image: url({{ verImagen($item->producto->imagen_path) }});"></div>
                            </td>
                            <td>
                                <div class="email">
                                    <span>{{ $item->producto->nombre }}</span>
                                    <span>{{ $item->almacen->nombre }}</span>
                                    <span>{{ $this->getDisponibles($item->almacenes_id, $item->productos_id) }} piezas disponibles</span>
                                </div>
                            </td>
                            <td>${{ formatoMillares($item->producto->precio) }}</td>
                            <td class="quantity">
                                <div class="input-group">
                                    <input type="number" name="quantity" id="input_cantidad_item_{{ $item->id }}"
                                           class="quantity form-control input-number @if($this->isInvalidStock($item->almacenes_id, $item->productos_id, $item->cantidad)) is-invalid @endif"
                                           value="{{ $item->cantidad }}"
                                           @change="cargando = true; setTimeout(() => cargando = false, 2000); if($event.target.value > 0){ Livewire.dispatch('setCantidad', { item_id: {{ $item->id }}, cantidad: $event.target.value }); }else{ $event.target.value = '{{ $item->cantidad }}' }"/>
                                    <small class="invalid-feedback text-danger">Excedido</small>
                                </div>
                            </td>
                            <td>${{ formatoMillares($item->cantidad * $item->producto->precio) }}</td>
                            <td>
                                <button type="button" wire:click="removeCart({{ $item->productos_id }})" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    <!-- Spinner overlay -->
                    <div wire:loading wire:target="checkOut" class="spinner-overlay align-content-center text-center">
                        <div class="spinner-border color-active" role="status"></div>
                    </div>

                    </tbody>
                </table>
            </div>
        </div>

        {{--Totales--}}
        <div class="row justify-content-end">
            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap @if($ftco_animate) ftco-animate @endif">
                <div class="cart-total mb-3">
                    <h3>Totales del Carrito</h3>
                    @include('web.section.totales-carrito')
                </div>
                <p class="text-center">
                    <button id="boton_procesar_pedido" wire:click="checkOut" wire:loading.attr="disabled" wire:target="removeCart, checkOut" type="button" class="btn btn-primary py-3 px-4" :disabled="cargando" >
                        Proceder al Pago
                    </button>
                </p>
            </div>
        </div>

    @endif

    <button id="buttonModalLoginFast_0" type="button" class="d-none" data-toggle="modal" data-target="#modalLoginFast">Modal Login Fast</button>

</div>
