<div class="container" x-data="{ deshabilitado: false }">
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

                        <tr>
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
                                           @focus="$wire.ocultar = true"
                                           {{--@blur="$wire.ocultar = false"--}}
                                           @change="Livewire.dispatch('setCantidad', { cantidad: $event.target.value, id: '{{$item->id}}', original: '{{ $item->cantidad }}' })"/>
                                    <small class="invalid-feedback text-danger">Excedido</small>
                                </div>
                            </td>
                            <td>${{ formatoMillares($item->cantidad * $item->producto->precio) }}</td>
                            <td>
                                <button type="button" wire:click="removeCart({{ $item->productos_id }})" class="close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    <!-- Spinner overlay -->
                    <div wire:loading wire:target="removeCart, checkOut" class="spinner-overlay align-content-center text-center">
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
                    <button wire:click="checkOut" x-show="!$wire.ocultar" type="button" class="btn btn-primary py-3 px-4">
                        Proceder al Pago
                    </button>
                    <button x-show="$wire.ocultar && !deshabilitado"
                            @click="
                                    deshabilitado = true;
                                    setTimeout(() => {
                                        $wire.ocultar = false
                                        deshabilitado = false;
                                    }, 2000)"
                            type="button" class="btn btn-primary py-3 px-4">
                        Recalcular
                    </button>
                    <button x-show="deshabilitado"
                            @click="setTimeout(() => $wire.ocultar = false, 2000)"
                            type="button" class="btn btn-primary py-3 px-4">
                        Recalculando...
                    </button>
                </p>
            </div>
        </div>

    @endif

</div>
