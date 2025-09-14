<div class="col-md-2">
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="sidebar-box @if($ftco_animate) ftco-animate @endif">
        <div class="categories position-relative">
            <h3>Gestionar</h3>
            <ul class="p-0">
                <li><a href="{{ route('web.home') }}">Mis Pedidos <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="{{ route('web.home', 'datos-facturacion') }}">Datos de Facturación <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="{{ route('web.profile') }}" class="color-active">{{ __('Profile') }} <span class="fa fa-chevron-right color-active"></span></a></li>
                <li>
                    <a href="#" wire:click.prevent="cerrarSesion">
                        {{ __('Logout') }} <span class="fa fa-chevron-right"></span>
                    </a>
                </li>
            </ul>
            <!-- Spinner overlay -->
            <div wire:loading wire:target="cerrarSesion" class="spinner-overlay align-content-center text-center">
                <div class="spinner-border color-active" role="status"></div>
            </div>
        </div>
    </div>

</div>
