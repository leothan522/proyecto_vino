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
                            <input type="text"
                                   wire:model="cedula"
                                   @change="if($event.target.value !== '') { cargando = true; setTimeout(() => cargando = false, 2000); Livewire.dispatch('getDatosFacturacion', { cedula: $event.target.value }); }"
                                   class="form-control" placeholder="Cédula" autofocus/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">Nombre Completo</label>
                            <input type="text" class="form-control" placeholder="Nombre Completo" disabled>
                        </div>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Parroquia</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach($parroquias as $parroquia)
                                        <option value="{{ $parroquia->parroquia }}">{{ $parroquia->parroquia }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control" placeholder="Teléfono">
                        </div>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="streetaddress">Dirección</label>
                            <input type="text" class="form-control" placeholder="Número de casa y nombre de la calle">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Apartamento, suite, unidad, etc.: (opcional)">
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
                                            <input type="radio" name="optradio" class="mr-2"/>
                                            Transferencia bancaria
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label onclick="modalPagoMovil()">
                                            <input type="radio" name="optradio" class="mr-2">
                                            Pago Móvil
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Referencia</label>
                                <input type="text" name="optradio" class="form-control" placeholder="#">
                            </div>
                            <div class="form-group">
                                <label>Monto</label>
                                <input type="text" name="optradio" class="form-control" placeholder="Bs.">
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

        </div>
    </div>

    <livewire:web.metodos-pagos-component
        total="{{ $total }}"
    />


</div>
