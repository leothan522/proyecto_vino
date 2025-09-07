<section class="ftco-section">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-10 ftco-animate">
                <form action="#" class="billing-form">
                    <h3 class="mb-4 billing-heading">Detalles de Facturación</h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Cédula</label>
                                <input type="text" class="form-control" placeholder="Cédula">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Nombre Completo</label>
                                <input type="text" class="form-control" placeholder="Nombre Completo">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Parroquia</label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="" id="" class="form-control">
                                        <option value="">France</option>
                                        <option value="">Italy</option>
                                        <option value="">Philippines</option>
                                        <option value="">South Korea</option>
                                        <option value="">Hongkong</option>
                                        <option value="">Japan</option>
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
                    </div>

                    <div class="row mt-4 pt-3 d-flex">
                    <div class="col-md-6 d-flex">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Totales del Carrito</h3>
                            <p class="d-flex">
                                <span>Subtotal</span>
                                <span>$20.60</span>
                            </p>
                            <p class="d-flex">
                                <span>Entrega</span>
                                <span>$0.00</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>$17.60</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Método de pago</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label data-toggle="modal" data-target="#exampleModal"><input type="radio" name="optradio" class="mr-2"> Transferencia bancaria</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label data-toggle="modal" data-target="#exampleModal"><input type="radio" name="optradio" class="mr-2"> Pago Móvil</label>
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
                            <p><a href="{{ route('web.home', 'mis-pedidos') }}" class="btn btn-primary py-3 px-4">Hacer un Pedido</a></p>
                        </div>
                    </div>
                </div>

                </form><!-- END -->
            </div> <!-- .col-md-8 -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
