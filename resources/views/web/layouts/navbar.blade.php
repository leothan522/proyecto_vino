<nav id="ftco-navbar"
     class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light <!--ftco_navbar--> scrolled awake">
    <div x-data="{ activo: null }" class="container">

        <a class="navbar-brand" href="{{ route('web.index') }}" @click="activo = 1; window.dispatchEvent(new CustomEvent('showLoader'));">
            <small>Vino <span>Don Juan Espinoza</span></small>
        </a>

        <livewire:web.order-last-component/>

        <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            {{--<span class="oi oi-menu"></span> Menu--}}
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item @if(Route::currentRouteName() == 'web.index') active @endif">
                    <a href="{{ route('web.index') }}"
                       @click="activo = 1; window.dispatchEvent(new CustomEvent('showLoader'));"
                       :class="activo === 1 ? 'active' : ''"
                       class="nav-link">
                        Inicio
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.about') active @endif">
                    <a href="{{ route('web.about') }}"
                       @click="activo = 2; window.dispatchEvent(new CustomEvent('showLoader'));"
                       :class="activo === 2 ? 'active' : ''"
                       class="nav-link">
                        Acerca de
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.products') active @endif">
                    <a href="{{ route('web.products') }}"
                       @click="activo = 3; window.dispatchEvent(new CustomEvent('showLoader'));"
                       :class="activo === 3 ? 'active' : ''"
                       class="nav-link">
                        Productos
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.home') active @endif">
                    <a href="{{ route('web.home') }}"
                       @click="activo = 4; window.dispatchEvent(new CustomEvent('showLoader'));"
                       :class="activo === 4 ? 'active' : ''"
                       class="nav-link">
                        Mi Cuenta
                        <small id="navbarInformacionUser"
                               class="color-active float-right font-italic text-uppercase d-md-none">
                            @auth
                                {{ \Illuminate\Support\Str::limit(auth()->user()->name, 25) }}
                            @endauth
                        </small>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.blog') active @endif">
                    <a href="{{ route('web.blog') }}"
                       @click="activo = 5; window.dispatchEvent(new CustomEvent('showLoader'));"
                       :class="activo === 5 ? 'active' : ''"
                       class="nav-link">
                        Galería
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'web.contact') active @endif">
                    <a href="{{ route('web.contact') }}"
                       @click="activo = 6; window.dispatchEvent(new CustomEvent('showLoader'));"
                       :class="activo === 6 ? 'active' : ''"
                       class="nav-link">
                        Contacto
                    </a>
                </li>
                <li class="nav-item d-md-none @if(Route::currentRouteName() == 'web.compartir') active @endif">
                    <a href="{{ route('web.compartir') }}"
                       @click="activo = 7; window.dispatchEvent(new CustomEvent('showLoader'));"
                       :class="activo === 7 ? 'active' : ''"
                       class="nav-link">
                        Compartir QR
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a href="{{ route('filament.dashboard.pages.dashboard') }}"
                       @click="activo = 8; window.dispatchEvent(new CustomEvent('showLoader'));"
                       :class="activo === 8 ? 'active' : ''"
                       class="nav-link">
                        {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>
        </div>

        {{--<div x-show="activo" class="spinner-overlay align-content-center d-md-none">
            <div class="spinner-border color-active" role="status"></div>
        </div>--}}

    </div>
</nav>
<!-- END nav -->
