<div id="div_pedidos">
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="@if($ftco_animate) ftco-animate @endif">

        {{--Lista de pedidos--}}
        <div class="list-group">

            <a class="list-group-item">
                <h5 class="font-italic color-active mb-1">Mis Pedidos</h5>
            </a>

            @foreach($pedidos as $pedido)
                <a href="#" wire:click.prevent="show({{ $pedido->id }})" class="list-group-item list-group-item-action position-relative">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Pedido <span class="color-active">{{ $pedido->codigo ? '#'.$pedido->codigo : 'Incompleto' }}</span></h5>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($pedido->created_at)->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1 @if(!$pedido->cedula) d-none @endif">Cliente:<strong>{{ formatoMillares($pedido->cedula, 0) }} - {{ \Illuminate\Support\Str::upper($pedido->nombre) }}</strong></p>
                    <p class="mb-1">{{ $pedido->bodega }} <strong class="float-right">${{ formatoMillares($pedido->total) }}</strong></p>
                    @switch($pedido->estatus)
                        @case(1)
                            <small class="text-muted"><i class="fa fa-clock-o mr-2" aria-hidden="true"></i>Validando Pago</small>
                            @break
                        @case(2)
                            <small class="text-muted"><i class="fa fa-truck mr-2" aria-hidden="true"></i>En proceso de entrega</small>
                            @break
                        @case(3)
                            <small class="text-muted"><i class="fa fa-truck mr-2" aria-hidden="true"></i>En proceso de entrega</small>
                            @break
                        @case(4)
                            <small class="text-success"><i class="fa fa-check-circle mr-2" aria-hidden="true"></i>Entregado</small>
                            @break
                        @default
                            <small class="text-primary">Se require atención</small>
                            @break
                    @endswitch
                    <!-- Spinner overlay -->
                    <div wire:loading wire:target="show({{ $pedido->id }})"
                         class="spinner-overlay align-content-center text-center">
                        <div class="spinner-border color-active" role="status"></div>
                    </div>
                </a>
            @endforeach

            <!-- Spinner overlay -->
            <div id="spinner_eliminar_pedido" class="spinner-overlay align-content-center text-center d-none">
                <div class="spinner-border color-active" role="status"></div>
            </div>

        </div>

        {{--Section Paginacion--}}
        {{ $pedidos->links('web.section.pagination-links') }}

    </div>

    <button id="buttonModalPedidos" class="d-none" type="button" data-toggle="modal" data-target="#modalPedidos">Modal Pedidos</button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalPedidos" data-backdrop="static" data-keyboard="false"
         tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form {{--wire:submit="login"--}} class="billing-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pedido <span class="color-active">{{ $codigo }}</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body position-relative" style="max-height: 70vh; overflow-y: auto;">

                        {{-- Datos del cliente --}}
                        <div class="mb-4 @if($is_process) d-none @endif">
                            <p class="mb-1">Cliente: <strong class="font-weight-bold">{{ $cliente }}</strong></p>
                            <p class="mb-0">Teléfono: <strong class="font-weight-bold">{{ $telefono }}</strong></p>
                        </div>

                        {{-- Lista de productos --}}
                        <p class="mb-2 font-weight-bold text-muted">Productos:</p>
                        <ul class="list-group mb-4">
                            @foreach($productos as $producto)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ \Str::upper($producto->producto) }} ref: {{ formatoMillares($producto->precio) }} x{{ $producto->cantidad }}</span>
                                    <span class="text-dark font-weight-bold">${{ formatoMillares($producto->precio * $producto->cantidad) }}</span>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Totales --}}
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal:</span>
                                <span class="font-weight-bold text-dark">${{ $verSubtotal }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Entrega:</span>
                                <span class="font-weight-bold text-dark">${{ $verEntrega }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total:</span>
                                <span class="font-weight-bold text-success">${{ $verTotal }}</span>
                            </li>
                        </ul>

                        {{-- Dirección --}}
                        <div class="mb-4 @if($is_process) d-none @endif">
                            <p class="mb-1"><i class="fa fa-map-marker mr-2"></i> Municipio: <strong>{{ $municipio }}</strong></p>
                            <p class="mb-1">Parroquia: <strong>{{ $parroquia }}</strong></p>
                            <p class="mb-0">Dirección: <strong>{{ $direccion }}</strong></p>
                        </div>

                        {{-- Pago --}}
                        <div class="mb-4 @if($is_process) d-none @endif">
                            <p class="mb-1">Método de pago: <strong class="float-right">{{ \Str::upper($metodo) }}</strong></p>
                            <p class="mb-1">Referencia: <strong class="float-right">{{ $referencia }}</strong></p>
                            <p class="mb-0">Monto: <strong class="float-right">Bs. {{ $monto }}</strong></p>
                        </div>

                        {{-- Estatus --}}
                        <div class="mb-4">
                            <p class="mb-1">Estatus:
                                <strong class="float-right">
                                    @switch($estatus)
                                        @case(1)
                                            <span class="text-muted"><i class="fa fa-clock-o mr-2" aria-hidden="true"></i>Validando Pago</span>
                                            @break
                                        @case(2)
                                            <span class="text-muted"><i class="fa fa-truck mr-2" aria-hidden="true"></i>En proceso de entrega</span>
                                            @break
                                        @case(3)
                                            <span class="text-muted"><i class="fa fa-truck mr-2" aria-hidden="true"></i>En proceso de entrega</span>
                                            @break
                                        @case(4)
                                            <span class="text-success"><i class="fa fa-check-circle mr-2" aria-hidden="true"></i>Entregado</span>
                                            @break
                                        @default
                                            <span class="text-primary">Se require atención</span>
                                            @break
                                    @endswitch
                                </strong>
                            </p>
                        </div>

                        {{-- Código de entrega --}}
                        @if($codigoEntrega)
                            <div class="mb-4 text-center">
                                <p class="mb-2 text-muted font-weight-bold">
                                    Código de Entrega
                                </p>
                                <div class="h4 font-weight-bold text-dark bg-light border rounded d-inline-block px-4 py-2 shadow-sm">
                                    {{ $codigoEntrega }}
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="modal-footer justify-content-between">
                        <small class="text-muted">{{ \Carbon\Carbon::parse($created_at)->diffForHumans() }}</small>
                        <div x-data class="row">
                            <button type="button" class="btn btn-danger mr-2 @if(!$is_process) d-none @endif" id="btnDescartarPedido"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <button type="button" wire:click="irCheckout" @click="window.dispatchEvent(new CustomEvent('showLoader'));" class="btn btn-primary mr-2 @if(!$is_process) d-none @endif" data-dismiss="modal">Pagar</button>
                            <button id="cerrarModalLoginFast" type="button" class="btn btn-secondary mr-2" data-dismiss="modal">{{ __('Close') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


