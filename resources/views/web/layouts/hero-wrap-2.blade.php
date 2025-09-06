<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('vendor/liquorstore/images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate mb-5 text-center">
                <p class="breadcrumbs mb-0">
                    <span class="mr-2">
                        <a href="{{ route('web.index') }}">Inicio <i class="fa fa-chevron-right"></i></a>
                    </span>
                    @if(Route::currentRouteName() == 'web.single')
                        <span class="mr-2">
                        <a href="{{ route('web.products') }}">Productos <i class="fa fa-chevron-right"></i></a>
                    </span>
                    @endif
                    <span>
                        @php
                            echo match (Route::currentRouteName()){
                                'web.about' => 'Acerca de',
                                'web.products' => 'Productos',
                                'web.single' => 'Ver Producto',
                                'web.cart' => 'Carrito',
                                'web.checkout' => 'Caja',
                                'web.home' => 'Mi Cuenta',
                                'web.blog' => 'Blog',
                                'web.contact' => 'Contacto',
                                default => 'Inicio',
                            }
                        @endphp
                        <i class="fa fa-chevron-right"></i>
                    </span>
                </p>
                <h2 class="mb-0 bread">
                    @php
                        echo match (Route::currentRouteName()){
                            'web.about' => 'Acerca de',
                            'web.products' => 'Productos',
                            'web.single' => 'Ver Producto',
                            'web.cart' => 'Carrito',
                            'web.checkout' => 'Caja',
                            'web.home' => 'Mi Cuenta',
                            'web.blog' => 'Blog',
                            'web.contact' => 'Contacto',
                            default => 'Inicio',
                        }
                    @endphp
                </h2>
            </div>
        </div>
    </div>
</section>
