<div id="div_pedidos">
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="@if($ftco_animate) ftco-animate @endif">

        {{--Lista de pedidos--}}
        <div class="list-group">

            <a class="list-group-item">
                <p class="mb-1">Mis Pedidos</p>
            </a>

            @foreach($pedidos as $pedido)
                <a href="#" wire:click.prevent="show({{ $pedido->id }})" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Pedido <span class="color-active">#{{ $pedido->codigo }}</span></h5>
                        <small
                            class="text-muted">{{ \Carbon\Carbon::parse($pedido->created_at)->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">Cliente:
                        <strong>{{ formatoMillares($pedido->cedula, 0) }} - {{ \Illuminate\Support\Str::upper($pedido->nombre) }}</strong></p>
                    <p class="mb-1">{{ $pedido->bodega }} <strong
                            class="float-right">${{ formatoMillares($pedido->total) }}</strong></p>
                    @switch($pedido->estatus)
                        @case(1)
                            <small class="text-muted">En proceso</small>
                            @break
                        @case(2)
                            <small class="text-success">Entregado</small>
                            @break
                        @case(3)
                            <small class="text-danger">Se require atención</small>
                            @break
                        @default
                            <small class="text-primary">Pedido incompleto</small>
                            @break
                    @endswitch
                    <!-- Spinner overlay -->
                    <div wire:loading wire:target="show({{ $pedido->id }})"
                         class="spinner-overlay align-content-center text-center">
                        <div class="spinner-border color-active" role="status"></div>
                    </div>
                </a>
            @endforeach

            {{-- <!-- Spinner overlay -->
             <div wire:loading wire:target="show" class="spinner-overlay align-content-center text-center">
                 <div class="spinner-border color-active" role="status"></div>
             </div>--}}

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
                        <h5 class="modal-title" id="exampleModalLabel">Pedido <span
                                class="color-active">#{{ $pedido->codigo }}</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body position-relative">

                        <p class="mb-1">Cliente: <strong>{{ \Illuminate\Support\Str::upper($cliente) }}</strong></p>
                        <p class="mb-4">Teléfono: <strong>{{ $telefono }}</strong></p>

                        <p class="mb-1">Productos:</p>
                        <ul class="list-group mb-4">
                            @foreach($productos as $producto)
                                <li class="list-group-item justify-between">
                                    <span>{{ \Illuminate\Support\Str::upper($producto->producto )}} ref: {{ formatoMillares($producto->precio) }} x{{ $producto->cantidad }}</span>
                                    <span class="float-right">${{ formatoMillares($producto->precio * $producto->cantidad) }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item">
                                <span>Subtotal:</span>
                                <span class="float-right">${{ $verSubtotal }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Entrega:</span>
                                <span class="float-right">${{ $verEntrega }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Total:</span>
                                <span class="float-right">${{ $verTotal }}</span>
                            </li>
                        </ul>

                        <p class="mb-1">Municipio: <strong>{{ $municipio }}</strong></p>
                        <p class="mb-1">Parroquia: <strong>{{ $parroquia }}</strong></p>
                        <p class="mb-4">Dirección: <strong>{{ $direccion }}</strong></p>
                        <p class="mb-1">Método de pago: <strong class="float-right">{{ \Illuminate\Support\Str::upper($metodo) }}</strong></p>
                        <p class="mb-1">Referencia: <strong class="float-right">{{ $referencia }}</strong></p>
                        <p class="mb-4">Monto: <strong class="float-right">Bs. {{ $monto }}</strong></p>
                        <p class="mb-1">
                            Estatus:
                            <strong class="float-right">
                                @switch($estatus)
                                    @case(1)
                                        <span class="text-muted">En proceso</span>
                                        @break
                                    @case(2)
                                        <span class="text-success">Entregado</span>
                                        @break
                                    @case(3)
                                        <span class="text-danger">Se require atención</span>
                                        @break
                                    @default
                                        <span class="text-primary">Pedido incompleto</span>
                                        @break
                                @endswitch
                            </strong></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <small
                            class="text-muted">{{ \Carbon\Carbon::parse($created_at)->diffForHumans() }}</small>
                        <button id="cerrarModalLoginFast" type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Close') }}</button>
                        {{--<button type="submit" class="btn btn-primary">{{ __('Login') }}</button>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


