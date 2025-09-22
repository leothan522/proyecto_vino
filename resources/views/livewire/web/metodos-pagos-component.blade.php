<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <!-- Modal Transferencia -->
    <button id="triggerModalMetodosTransferencias" wire:click="showModalMetodos" type="button"
            class="btn btn-primary d-none" data-toggle="modal" data-target="#BancosTransferencias">
        Transferencia Bancaria
    </button>

    <div wire:ignore.self class="modal fade" id="BancosTransferencias" data-backdrop="static" data-keyboard="false"
         tabindex="-1" aria-labelledby="BancosTransferenciasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transferencia bancaria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body position-relative">
                    <p class="text-justify">
                        Asegurate de pagar correctamente, recuerda que los datos bancarios son unicos.
                    </p>

                    <div class="input-group mb-3">
                        <input wire:model="titularTransferencia" type="text" class="form-control" placeholder="Titular" aria-label="Titular" aria-describedby="button-addon1" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $titularTransferencia }}')"
                                    class="btn btn-outline-secondary" type="button" id="button-addon1"
                                    data-container="body" data-toggle="popover" data-placement="left"
                                    data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input wire:model="cuentaTransferencia" type="text" class="form-control" placeholder="Cuenta" aria-label="Cuenta" aria-describedby="button-addon2" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $cuentaTransferencia }}')"
                                    class="btn btn-outline-secondary" type="button" id="button-addon2"
                                    data-container="body" data-toggle="popover" data-placement="left"
                                    data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input wire:model="rifTransferencia" type="text" class="form-control" placeholder="RIF" aria-label="RIF" aria-describedby="button-addon3" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $rifTransferencia }}')"
                                    class="btn btn-outline-secondary" type="button" id="button-addon3"
                                    data-container="body" data-toggle="popover" data-placement="left"
                                    data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input wire:model="tipoTransferencia" type="text" class="form-control" placeholder="Tipo" aria-label="Tipo" aria-describedby="button-addon4" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $tipoTransferencia }}')"
                                    class="btn btn-outline-secondary" type="button" id="button-addon4"
                                    data-container="body" data-toggle="popover" data-placement="left"
                                    data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input wire:model="bancoTransferencia" type="text" class="form-control" placeholder="Banco" aria-label="Banco" aria-describedby="button-addon5" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $bancoTransferencia }}')"
                                    class="btn btn-outline-secondary" type="button" id="button-addon5"
                                    data-container="body" data-toggle="popover" data-placement="left"
                                    data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>



                    <div class="input-group mb-3 @if(!$oficial) d-none @endif">
                        <input wire:model="montoBs" type="number" class="form-control" placeholder="Monto" aria-label="Monto" aria-describedby="button-addon6" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $montoBs }}')" class="btn btn-outline-secondary"
                                    type="button" id="button-addon6" data-container="body" data-toggle="popover"
                                    data-placement="left" data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>

                    @if($oficial)
                        <div class="input-group justify-content-between">
                            <small>BCV Oficial USD: {{ formatoMillares($oficial) }}</small>
                            <small>Fecha Actualización: {{ $fecha }}</small>
                        </div>

                    @endif

                    <!-- Spinner overlay -->
                    <div wire:loading wire:target="showModalMetodos" class="spinner-overlay align-content-center text-center">
                        <div class="spinner-border color-active" role="status"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal PagoMovil -->
    <button id="triggerModalMetodosPagoMovil" wire:click="showModalMetodos" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#BancosPagoMovil">
        Pago Movil
    </button>

    <div wire:ignore.self class="modal fade" id="BancosPagoMovil" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pago Móvil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body position-relative">
                    <p class="text-justify">
                        Asegurate de pagar correctamente, recuerda que los datos bancarios son unicos.
                    </p>

                    <div class="input-group mb-3">
                        <input wire:model="bancoPagoMovil" type="text" class="form-control" placeholder="Banco" aria-label="Banco" aria-describedby="button-addon7" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $codigoPagoMovil }}')"
                                    class="btn btn-outline-secondary" type="button" id="button-addon7"
                                    data-container="body" data-toggle="popover" data-placement="left"
                                    data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input wire:model="rifPagoMovil" type="text" class="form-control" placeholder="RIF" aria-label="RIF" aria-describedby="button-addon8" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $rifPagoMovil }}')" class="btn btn-outline-secondary"
                                    type="button" id="button-addon8" data-container="body" data-toggle="popover"
                                    data-placement="left" data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input wire:model="telefonoPagoMovil" type="text" class="form-control" placeholder="Teléfono" aria-label="Teléfono" aria-describedby="button-addon9" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $telefonoPagoMovil }}')"
                                    class="btn btn-outline-secondary" type="button" id="button-addon9"
                                    data-container="body" data-toggle="popover" data-placement="left"
                                    data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>


                    <div class="input-group mb-3 @if(!$oficial) d-none @endif">
                        <input wire:model="montoBs" type="number" class="form-control" placeholder="Monto" aria-label="Monto" aria-describedby="button-addon10" readonly>
                        <div class="input-group-append">
                            <button onclick="copiarContenido('{{ $montoBs }}')" class="btn btn-outline-secondary"
                                    type="button" id="button-addon10" data-container="body" data-toggle="popover"
                                    data-placement="left" data-content="Copiado">Copiar
                            </button>
                        </div>
                    </div>

                    <button onclick="copiarContenido('{{ $smsPagoMovil }}')"
                            class="btn btn-outline-secondary btn-block mb-3" type="button" data-container="body"
                            data-toggle="popover" data-placement="top" data-content="Copiado">Copiar datos para SMS
                    </button>

                    @if($oficial)

                        <div class="input-group justify-content-between">
                            <small>BCV Oficial USD: {{ formatoMillares($oficial) }}</small>
                            <small>Fecha Actualización: {{ $fecha }}</small>
                        </div>

                    @endif

                    <!-- Spinner overlay -->
                    <div wire:loading wire:target="showModalMetodos"
                         class="spinner-overlay align-content-center text-center">
                        <div class="spinner-border color-active" role="status"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

</div>
