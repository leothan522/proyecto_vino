<div class="container" x-data="{ cargando: false }">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    {{--Tabla Los Productos--}}
    @if($items->isNotEmpty())

        <div class="row @if($ftco_animate) ftco-animate @endif">
            <div class="table-responsive">
                <table class="table d-none d-md-table">
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
                                    <input type="number" id="input_cantidad_item_{{ $item->id }}"
                                           class="quantity form-control input-number @if($this->isInvalidStock($item->almacenes_id, $item->productos_id, $item->cantidad)) is-invalid @endif"
                                           value="{{ $item->cantidad }}"
                                           @change="cargando = true; setTimeout(() => cargando = false, 2000); if($event.target.value > 0){ Livewire.dispatch('setCantidad', { item_id: {{ $item->id }}, cantidad: $event.target.value }); }else{ $event.target.value = '{{ $item->cantidad }}' }"/>
                                    <small class="invalid-feedback text-danger">Excedido</small>
                                </div>
                            </td>
                            <td>${{ formatoMillares($item->cantidad * $item->producto->precio) }}</td>
                            <td>
                                <button type="button" wire:click="removeCart({{ $item->productos_id }})" class="close"
                                        data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    <!-- Spinner overlay -->
                    <div wire:loading wire:target="checkOut, removeCart"
                         class="spinner-overlay align-content-center text-center">
                        <div class="spinner-border color-active" role="status"></div>
                    </div>

                    </tbody>
                </table>
            </div>
        </div>

        <ul class="list-group @if($ftco_animate) ftco-animate @endif d-md-none">
            @foreach($items as $item)
                <div class="list-group-item d-flex align-items-start alert" role="alert" href="#">
                    <div class="p-2">
                        <div class="img"
                             style="background-image: url({{ verImagen($item->producto->imagen_path) }}); min-width: 80px !important; min-height: 80px !important;">
                            &nbsp;
                        </div>
                    </div>
                    <div class="text pl-3">
                        <button type="button" wire:click="removeCart({{ $item->productos_id }})" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="text-muted" aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                        <h4>{{ $item->producto->nombre }}</h4>
                        <small>{{ $item->almacen->nombre }}</small>
                        <p class="mb-2">
                            <a href="{{ route('web.single', $item->productos_id) }}"
                               class="price">${{ formatoMillares($item->producto->precio) }}</a>
                            <span
                                class="quantity ml-3">Disponible: {{ $this->getDisponibles($item->almacenes_id, $item->productos_id) }}</span>
                        </p>


                        <div class="col-12 product-details p-0 mb-2">

                            {{--Botones Cantidad--}}
                            <div class="row">
                                <div class="input-group col-md-6 d-flex mb-3 position-relative">

                                    {{-- Boton Menos--}}
                                    <span class="input-group-btn mr-2 pt-1">
                                            Cantidad:
                                        </span>

                                    {{--Input Cantidad--}}
                                    <input type="number"
                                           class="quantity form-control input-number @if($this->isInvalidStock($item->almacenes_id, $item->productos_id, $item->cantidad)) is-invalid @endif"
                                           value="{{ $item->cantidad }}"
                                           @change="cargando = true; setTimeout(() => cargando = false, 2000); if($event.target.value > 0){ Livewire.dispatch('setCantidad', { item_id: {{ $item->id }}, cantidad: $event.target.value }); }else{ $event.target.value = '{{ $item->cantidad }}' }"/>

                                    <small class="invalid-tooltip">Excedido</small>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            @endforeach
        </ul>

        {{--Totales--}}
        <div class="row justify-content-end">
            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap @if($ftco_animate) ftco-animate @endif">
                <div class="cart-total mb-3 bg-white">
                    <h3>Totales del Carrito</h3>
                    @include('web.section.totales-carrito')
                </div>
                <p class="text-center">
                    <button id="boton_procesar_pedido" wire:click="checkOut" wire:loading.attr="disabled"
                            wire:target="removeCart, checkOut" type="button" class="btn btn-primary py-3 px-4"
                            :disabled="cargando">
                        Proceder al Pago
                    </button>
                </p>
            </div>
        </div>

    @endif

    <button id="buttonModalLoginFast_0" type="button" class="d-none" data-toggle="modal" data-target="#modalLoginFast">
        Modal Login Fast
    </button>

</div>
