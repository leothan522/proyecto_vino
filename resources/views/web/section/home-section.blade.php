<section class="ftco-section">
    <div class="container">
        <div class="row">
            {{--Content home--}}
            <div class="col-md-10 order-last">

                {{--Mis Pedidos--}}
                <div class="ftco-animate" id="div_pedidos">

                    {{--Lista de pedidos--}}
                    <div class="list-group">
                        <a class="list-group-item">
                            <p class="mb-1">Mis Pedidos</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Pedido <span class="color-active">#12563</span></h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Cliente: <strong>20025623 YONATHAN LEONARDO CASTILLO ROMERO</strong></p>
                            <p class="mb-1">Total: <strong>$16.60</strong></p>
                            <small class="text-success">Entregado</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Pedido <span class="color-active">#12563</span></h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Cliente: <strong>20025623 YONATHAN LEONARDO CASTILLO ROMERO</strong></p>
                            <p class="mb-1">Total: <strong>$16.60</strong></p>
                            <small class="text-muted">En proceso</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Pedido <span class="color-active">#12563</span></h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Cliente: <strong>20025623 YONATHAN LEONARDO CASTILLO ROMERO</strong></p>
                            <p class="mb-1">Total: <strong>$16.60</strong></p>
                            <small class="text-danger">Se require atención</small>
                        </a>

                    </div>

                    {{--Section Paginacion--}}
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                {{--Datos Facturacion--}}
                <div class="d-none" id="div_facturacion">

                    {{--Lista facturacion--}}
                    <div class="list-group">
                        <a class="list-group-item">
                            <p class="mb-1">Datos de Facturación</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Cédula: <span class="color-active">20025623</span></h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Nombre: <strong>YONATHAN LEONARDO CASTILLO ROMERO</strong></p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Cédula: <span class="color-active">20025623</span></h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Nombre: <strong>YONATHAN LEONARDO CASTILLO ROMERO</strong></p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Cédula: <span class="color-active">20025623</span></h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Nombre: <strong>YONATHAN LEONARDO CASTILLO ROMERO</strong></p>
                        </a>

                    </div>

                    {{--Section Paginacion--}}
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            {{--Menu Home--}}
            <div class="col-md-2">

                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Gestionar</h3>
                        <ul class="p-0">
                            <li><a href="#" onclick="verPedidos(); return false" class="color-active">Mis Pedidos <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#" onclick="verFacturacion(); return false">Datos de Facturación <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="{{ route('web.profile') }}">{{ __('Profile') }} <span class="fa fa-chevron-right color-active"></span></a></li>
                            <li>
                                <a href="#" onclick="document.getElementById('form_logout').submit(); return false">
                                    {{ __('Logout') }} <span class="fa fa-chevron-right"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" id="form_logout">
                    @csrf
                </form>

            </div>
        </div>
    </div>
</section>
