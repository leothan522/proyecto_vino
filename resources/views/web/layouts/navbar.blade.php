<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('web.index') }}">
            <div class="d-none d-md-block">Vino <span>Guariqueño</span></div>
            <small class="d-md-none">Vino <span>Guariqueño</span></small>
        </a>

        @include('web.section.order-last')

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item @if(Route::currentRouteName() == 'web.index') active @endif"><a href="{{ route('web.index') }}" class="nav-link">Inicio</a></li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.about') active @endif"><a href="{{ route('web.about') }}" class="nav-link">Acerca de</a></li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.products') active @endif"><a href="{{ route('web.products') }}" class="nav-link">Productos</a></li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.home') active @endif"><a href="{{ route('web.home') }}" class="nav-link">Mi Cuenta</a></li>
                {{--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Products</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="product.html">Products</a>
                        <a class="dropdown-item" href="product-single.html">Single Product</a>
                        <a class="dropdown-item" href="cart.html">Cart</a>
                        <a class="dropdown-item" href="checkout.html">Checkout</a>
                    </div>
                </li>--}}
                <li class="nav-item @if(Route::currentRouteName() == 'web.blog') active @endif"><a href="{{ route('web.blog') }}" class="nav-link">Blog</a></li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.contact') active @endif"><a href="{{ route('web.contact') }}" class="nav-link">Contacto</a></li>
            </ul>
        </div>

    </div>
</nav>
<!-- END nav -->
