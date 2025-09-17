<nav id="ftco-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light <!--ftco_navbar--> scrolled awake" >
    <div class="container">
        <a class="navbar-brand" href="{{ route('web.index') }}">
            <small>Vino <span>Don Juan Espinoza</span></small>
        </a>

        <livewire:web.order-last-component />

        <button class="navbar-toggler ml-3 mr-3" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            {{--<span class="oi oi-menu"></span> Menu--}}
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item @if(Route::currentRouteName() == 'web.index') active @endif"><a href="{{ route('web.index') }}" class="nav-link">Inicio</a></li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.about') active @endif"><a href="{{ route('web.about') }}" class="nav-link">Acerca de</a></li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.products') active @endif"><a href="{{ route('web.products') }}" class="nav-link">Productos</a></li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.home') active @endif"><a href="{{ route('web.home') }}" class="nav-link">Mi Cuenta</a></li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.blog') active @endif"><a href="{{ route('web.blog') }}" class="nav-link">Galería</a></li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.contact') active @endif"><a href="{{ route('web.contact') }}" class="nav-link">Contacto</a></li>
                <li class="nav-item d-md-none"><a href="{{ route('filament.dashboard.pages.dashboard') }}" class="nav-link">{{ __('Dashboard') }}</a></li>
            </ul>
        </div>

    </div>
</nav>
<!-- END nav -->
