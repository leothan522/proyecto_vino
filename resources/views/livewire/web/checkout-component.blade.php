<div class="container">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="row justify-content-center">
        <div x-data="{ cargando: false }" class="col-xl-10 @if($ftco_animate) ftco-animate @endif">
            <form id="formCheckout" wire:submit="saveOrder" class="billing-form">

                {{--Detalles de Facturación--}}
                <h3 class="mb-4 billing-heading">Detalles de Facturación</h3>
                <div class="row align-items-end">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailaddress">Cédula <small class="ml-2 text-danger">Ingrese primero la Cédula</small></label>
                            <input type="number" step="1" min="0"
                                   wire:model="cedula"
                                   @change="if($event.target.value !== '') { cargando = true; setTimeout(() => cargando = false, 2000); Livewire.dispatch('getDatosFacturacion', { cedula: $event.target.value }); }"
                                   class="form-control" placeholder="Cédula" autofocus/>
                            @error('cedula')
                            <small class="text-primary">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">Nombre Completo</label>
                            <input wire:model="nombre" type="text" class="form-control" placeholder="Nombre Completo" @if($disableInput) disabled @endif>
                            @error('nombre')
                            <small class="text-primary">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Parroquia</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select wire:model="parroquias_id" class="form-control" @if($disableInput) disabled @endif>
                                    <option value="">Seleccione</option>
                                    @foreach($parroquias as $parroquia)
                                        <option value="{{ $parroquia->id }}">{{ $parroquia->parroquia }}</option>
                                    @endforeach
                                </select>
                                @error('parroquias_id')
                                <small class="text-primary">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input wire:model="telefono" type="text" class="form-control" placeholder="Teléfono" @if($disableInput) disabled @endif>
                            @error('telefono')
                            <small class="text-primary">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="streetaddress">Dirección</label>
                            <input wire:model="direccion" type="text" class="form-control" placeholder="Número de casa y nombre de la calle" @if($disableInput) disabled @endif>
                            @error('direccion')
                            <small class="text-primary">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input wire:model="direccion2" type="text" class="form-control" placeholder="Apartamento, suite, unidad, etc.: (opcional)" @if($disableInput) disabled @endif>
                            @error('direccion')
                            <small class="text-primary">&nbsp;</small>
                            @enderror
                        </div>
                    </div>

                    {{--END DATOS--}}
                </div>

                <div class="row mt-4 pt-3 d-flex">

                    <div class="col-md-6 d-flex">
                        {{--Totales del Carrito--}}
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Totales del Carrito</h3>
                            @include('web.section.totales-carrito')
                        </div>
                    </div>

                    <div class="col-md-6">

                        {{-- Metodo de pago --}}
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Método de pago</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label onclick="modalTransferencias()">
                                            <input type="radio" value="transferencias" wire:model="metodoPago" class="mr-2"/>
                                            Transferencia bancaria
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label onclick="modalPagoMovil()">
                                            <input type="radio" value="pagomovil" wire:model="metodoPago" class="mr-2">
                                            Pago Móvil
                                        </label>
                                    </div>
                                    @error('metodoPago')
                                    <small class="text-primary">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Referencia</label>
                                <input wire:model="referencia" type="text" class="form-control" placeholder="#">
                                @error('referencia')
                                <small class="text-primary">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Monto</label>
                                <input wire:model="monto" type="number" step="0.01" min="0" class="form-control" placeholder="Bs.">
                                @error('monto')
                                <small class="text-primary">{{ $message }}</small>
                                @enderror
                            </div>
                            <p>
                                <button type="submit" class="btn btn-primary py-3 px-4" :disabled="cargando">
                                    Hacer un Pedido
                                </button>
                            </p>
                        </div>

                    </div>
                </div>

            </form>

            <!-- Spinner overlay -->
            <div x-show="cargando" class="spinner-overlay align-content-center text-center">
                <div class="spinner-border color-active" role="status"></div>
            </div>

            <!-- Spinner overlay -->
            <div wire:loading wire:target="saveOrder" class="spinner-overlay align-content-center text-center">
                <div class="spinner-border color-active" role="status"></div>
            </div>

        </div>
    </div>

    <livewire:web.metodos-pagos-component
        total="{{ $total }}"
    />


</div>
