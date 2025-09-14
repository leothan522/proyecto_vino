<div class="container">

    {{--Tabla Los Productos--}}
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
                <tbody>

                <tr class="alert" role="alert">
                    <td>
                        <div class="img"
                             style="background-image: url({{ asset('vendor/liquorstore/images/prod-1.jpg') }});"></div>
                    </td>
                    <td>
                        <div class="email">
                            <span>Jim Beam Kentucky Straight</span>
                            <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                        </div>
                    </td>
                    <td>$44.99</td>
                    <td class="quantity">
                        <div class="input-group">
                            <input type="number" name="quantity" class="quantity form-control input-number" value="2" min="1" max="100">
                        </div>
                    </td>
                    <td>$89.98</td>
                    <td>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </td>
                </tr>

                <tr class="alert" role="alert">
                    <td>
                        <div class="img"
                             style="background-image: url({{ asset('vendor/liquorstore/images/prod-2.jpg') }});"></div>
                    </td>
                    <td>
                        <div class="email">
                            <span>Jim Beam Kentucky Straight</span>
                            <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                        </div>
                    </td>
                    <td>$30.99</td>
                    <td class="quantity">
                        <div class="input-group">
                            <input type="text" name="quantity" class="quantity form-control input-number" value="1"
                                   min="1" max="100">
                        </div>
                    </td>
                    <td>$30.99</td>
                    <td>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </td>
                </tr>
                <tr class="alert" role="alert">
                    <td>
                        <div class="img"
                             style="background-image: url({{ asset('vendor/liquorstore/images/prod-3.jpg') }});"></div>
                    </td>
                    <td>
                        <div class="email">
                            <span>Jim Beam Kentucky Straight</span>
                            <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                        </div>
                    </td>
                    <td>$35.50</td>
                    <td class="quantity">
                        <div class="input-group">
                            <input type="text" name="quantity" class="quantity form-control input-number" value="1"
                                   min="1" max="100">
                        </div>
                    </td>
                    <td>$35.50</td>
                    <td>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </td>
                </tr>
                <tr class="alert" role="alert">
                    {{--<td>
                        <label class="checkbox-wrap checkbox-primary">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>--}}
                    <td>
                        <div class="img"
                             style="background-image: url({{ asset('vendor/liquorstore/images/prod-4.jpg') }});"></div>
                    </td>
                    <td>
                        <div class="email">
                            <span>Jim Beam Kentucky Straight</span>
                            <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                        </div>
                    </td>
                    <td>$76.99</td>
                    <td class="quantity">
                        <div class="input-group">
                            <input type="text" name="quantity" class="quantity form-control input-number" value="1"
                                   min="1" max="100">
                        </div>
                    </td>
                    <td>$76.99</td>
                    <td>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </td>
                </tr>
                <tr class="alert" role="alert">
                    {{--<td class="border-bottom-0">
                        <label class="checkbox-wrap checkbox-primary">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>--}}
                    <td class="border-bottom-0">
                        <div class="img"
                             style="background-image: url({{ asset('vendor/liquorstore/images/prod-5.jpg') }});"></div>
                    </td>
                    <td class="border-bottom-0">
                        <div class="email">
                            <span>Jim Beam Kentucky Straight</span>
                            <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                        </div>
                    </td>
                    <td class="border-bottom-0">$40.00</td>
                    <td class="quantity border-bottom-0">
                        <div class="input-group">
                            <input type="text" name="quantity" class="quantity form-control input-number" value="1"
                                   min="1" max="100">
                        </div>
                    </td>
                    <td class="border-bottom-0">$40.00</td>
                    <td class="border-bottom-0">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

    {{--Totales--}}
    <div class="row justify-content-end">
        <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
                <h3>Totales del Carrito</h3>
                <p class="d-flex">
                    <span>Subtotal</span>
                    <span>$20.60</span>
                </p>
                <p class="d-flex">
                    <span>Entrega</span>
                    <span>$0.00</span>
                </p>
                {{--<p class="d-flex">
                    <span>Descuento</span>
                    <span>$3.00</span>
                </p>--}}
                <hr>
                <p class="d-flex total-price">
                    <span>Total</span>
                    <span>$17.60</span>
                </p>
            </div>
            <p class="text-center">
                <a href="{{ route('web.checkout') }}" class="btn btn-primary py-3 px-4">Proceder al Pago</a>
            </p>
        </div>
    </div>

</div>

