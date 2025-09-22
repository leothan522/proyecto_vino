<div id="div_facturacion">
    {{-- Do your work, then step back. --}}

    {{--Lista facturacion--}}
    <div class="list-group">
        <a class="list-group-item">
            <p class="mb-1">Datos de Facturación</p>
        </a>

        @foreach($clientes as $cliente)
            <a href="#" wire:click.prevent="show({{ $cliente->id }})" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Cédula: <span class="color-active">{{ formatoMillares($cliente->cedula, 0) }}</span></h5>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($cliente->created_at)->diffForHumans() }}</small>
                </div>
                <p class="mb-1">Nombre: <strong>{{ \Illuminate\Support\Str::upper($cliente->nombre) }}</strong></p>
                <div wire:loading wire:target="show({{ $cliente->id }})" class="spinner-overlay align-content-center text-center">
                    <div class="spinner-border color-active" role="status"></div>
                </div>
            </a>
        @endforeach

    </div>

    {{--Section Paginacion--}}
    {{ $clientes->links('web.section.pagination-links') }}


    <button id="buttonModalShowCliente" class="d-none" type="button" data-toggle="modal" data-target="#modalShowCliente">Modal</button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalShowCliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit="save" class="billing-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ver Detalles</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body position-relative" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="emailaddress">Cédula</label>
                                    <input type="number" step="1" min="0" wire:model="cedula" class="form-control" placeholder="Cédula" autofocus/>
                                    @error('cedula')
                                    <small class="text-primary">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="firstname">Nombre Completo</label>
                                    <input wire:model="nombre" type="text" class="form-control" placeholder="Nombre Completo">
                                    @error('nombre')
                                    <small class="text-primary">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="phone">Teléfono</label>
                                    <input wire:model="telefono" type="text" class="form-control" placeholder="Teléfono">
                                    @error('telefono')
                                    <small class="text-primary">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="streetaddress">Dirección</label>
                                    <input wire:model="direccion" type="text" class="form-control" placeholder="Número de casa y nombre de la calle">
                                    @error('direccion')
                                    <small class="text-primary">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <input wire:model="direccion2" type="text" class="form-control" placeholder="Apartamento, suite, unidad, etc.: (opcional)">
                                    @error('direccion')
                                    <small class="text-primary">&nbsp;</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!-- Spinner overlay -->
                        <div wire:loading wire:target="save" class="spinner-overlay align-content-center text-center">
                            <div class="spinner-border color-active" role="status"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <button id="cerrarModalShowCliente" type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
