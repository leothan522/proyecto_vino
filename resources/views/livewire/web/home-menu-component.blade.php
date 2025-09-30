<div class="col-md-2">
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="sidebar-box bg-transparent @if($ftco_animate) ftco-animate @endif">
        <div class="categories position-relative">
            <h3>Gestionar</h3>
            <ul class="p-0" @click="cargando = true; setTimeout(() => cargando = false, 3000)" >
                <li>
                    <a href="#" wire:click.prevent="showPedidos" onclick="verPedidos()" class="@if($isPedidos) color-active @endif">
                        Mis Pedidos <span class="fa fa-chevron-right @if($isPedidos) color-active @endif"></span>
                    </a>
                </li>
                <li class="d-none">
                    <a href="#" class="@if($isFavoritos) color-active @endif">
                        Mis Favoritos <span class="fa fa-chevron-right @if($isFavoritos) color-active @endif"></span>
                    </a>
                </li>
                <li>
                    <a href="#" wire:click.prevent="showDatos" onclick="verFacturacion()" class="@if($isDatos) color-active @endif">
                        Datos de Facturación <span class="fa fa-chevron-right @if($isDatos) color-active @endif"></span>
                    </a>
                </li>
                <li>
                    <a href="#" wire:click.prevent="showPerfil" onclick="verSpinnerCargando()" class="@if($isPerfil) color-active @endif">
                        {{ __('Profile') }} <span class="fa fa-chevron-right @if($isPerfil) color-active @endif"></span>
                    </a>
                </li>
                <li>
                    <a href="#" wire:click.prevent="cerrarSesion" onclick="verSpinnerCargando()">
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
