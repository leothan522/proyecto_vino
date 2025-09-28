<div class="container">
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div class="row @if($ftco_animate) ftco-animate @endif justify-content-center">
        <div class="col-md-12">
            <div class="wrapper px-md-4">
                <div class="row no-gutters justify-content-center">

                    <div class="col-md-7">

                        <div class="card @if(!$verPedido) d-none @endif">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Pedido <span class="color-active">#{{ $codigo }}</span>
                                    <small class="text-muted float-right">{{ $created_at }}</small>
                                </h5>

                                {{-- Datos del cliente --}}
                                <div class="mb-4">
                                    <p class="mb-1">Cliente: <strong class="font-weight-bold">{{ \Str::upper($cliente) }}</strong></p>
                                    <p class="mb-0">Teléfono: <strong class="font-weight-bold">{{ $telefono }}</strong>
                                        <small class="ml-2"><a href="tel:+{{ formatearTelefonoParaWhatsapp($telefono) }}"><i class="fa fa-phone mr-2" aria-hidden="true"></i>Realizar Llamada</a></small>
                                    </p>
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
                                <div class="mb-4">
                                    <p class="mb-1"><i class="fa fa-map-marker mr-2"></i> Municipio: <strong>{{ $municipio }}</strong></p>
                                    <p class="mb-1">Parroquia: <strong>{{ $parroquia }}</strong></p>
                                    <p class="mb-0">Dirección: <strong>{{ $direccion }}</strong></p>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <input type="button" value="Confirmar Entrega" class="btn btn-primary" data-toggle="modal" data-target="#codigoModal">
                                        <div class="submitting"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card border-success text-center mt-4 shadow-sm @if(!$verSuccess) d-none @endif" id="pedido-entregado">
                            <div class="card-body py-5">
                                <div class="mb-3">
                                    <i class="fa fa-check-circle text-success" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="text-success font-weight-bold">¡Pedido entregado con éxito!</h4>
                                <p class="text-muted mt-3 lead">
                                    Gracias por completar la entrega. ¡Buen trabajo!
                                </p>
                            </div>
                        </div>

                        <div class="card border-danger text-center mt-4 shadow-sm @if(!$verError) d-none @endif" id="pedido-error">
                            <div class="card-body py-5">
                                <div class="mb-3">
                                    <i class="fa fa-exclamation-circle text-danger" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="text-danger font-weight-bold">No se pudo encontrar el pedido</h4>
                                <p class="text-muted mt-3 lead">
                                    El enlace es incorrecto o el pedido ya no está disponible.
                                </p>
                            </div>
                        </div>

                        <!-- Spinner overlay -->
                        <div id="spinner-entrega-pedido" class="spinner-overlay align-content-center text-center d-none">
                            <div class="spinner-border color-active" role="status"></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bootstrap 4 -->
    <div class="modal fade" id="codigoModal" tabindex="-1" role="dialog" aria-labelledby="codigoModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Verificación de seguridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form wire:submit.prevent="enviar">
                        <div class="text-center mb-3">
                            <label class="d-block">Ingresa el código de 6 dígitos</label>
                            <div class="d-flex justify-content-center">
                                @foreach ($digitos as $i => $valor)
                                    <input type="tel"
                                           inputmode="numeric"
                                           pattern="\d*"
                                           maxlength="1"
                                           class="codigo-input"
                                           wire:model.lazy="digitos.{{ $i }}"
                                           oninput="avanzar(this, {{ $i }})"
                                           onkeydown="retroceder(event, {{ $i }})">
                                @endforeach
                            </div>
                        </div>

                        @error('codigo')
                        <div class="text-danger text-center mb-3">{{ $message }}</div>
                        @enderror

                        @if (session()->has('success'))
                            <div class="text-success text-center">{{ session('success') }}</div>
                        @endif

                        <button type="submit" class="btn btn-primary btn-block">Validar</button>
                    </form>

                    <!-- Spinner overlay -->
                    <div wire:loading wire:target="enviar" class="spinner-overlay align-content-center text-center">
                        <div class="spinner-border color-active" role="status"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .codigo-input {
            width: 40px;
            height: 50px;
            margin: 0 5px;
            font-size: 24px;
            text-align: center;
            border: 2px solid #ced4da;
            border-radius: 5px;
        }
        .codigo-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,.5);
        }
    </style>

    <script>
        function avanzar(input, index) {
            if (input.value.length === 1 && index < 5) {
                document.querySelectorAll('.codigo-input')[index + 1].focus();
            }
        }

        function retroceder(e, index) {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                document.querySelectorAll('.codigo-input')[index - 1].focus();
            }
        }

    </script>



</div>
