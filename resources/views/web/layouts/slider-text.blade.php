<div class="container">
    <div class="row ftco-animate">
        <div class="col-12 d-flex align-items-center justify-content-center mb-3">
            <h2 class="font-italic color-active">
                @php
                    echo match (Route::currentRouteName()){
                        'web.about' => 'Acerca de',
                        'web.products' => 'Productos',
                        'web.single' => 'Ver Producto',
                        'web.cart' => 'Mi Carrito',
                        'web.checkout' => 'Caja',
                        'web.home','web.profile' => 'Mi Cuenta',
                        'web.blog' => 'Galería',
                        'web.contact' => 'Contacto',
                        default => 'Inicio',
                    }
                @endphp
            </h2>
        </div>
    </div>
</div>
