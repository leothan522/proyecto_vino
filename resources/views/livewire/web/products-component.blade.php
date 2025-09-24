<div class="container">
    {{-- In work, do what you enjoy. --}}

    @if($almacenes_id)
        <div class="row pt-3">

            {{--Content Productos--}}
            <div class="col-md-9 mb-4 mb-md-auto">

                {{--Section Filtro--}}
                <div class="row mb-4">
                    {{--{{ json_encode($filtro) }}--}}
                    <div wire:ignore class="col-md-12 d-flex justify-content-between align-items-center">
                        <h4 class="product-select">Seleccionar Tipo</h4>
                        <select class="selectpicker" multiple title="Nada seleccionado" x-data x-on:change="$wire.set('filtro', Array.from($el.selectedOptions).map(o => o.value))">
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" @if(session()->has('tipos_id') && session('tipos_id') == $tipo->id) selected @endif>{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($productos->isNotEmpty())

                    {{--Section Lista de Productos--}}
                    @include('web.section.list-products')

                    {{--Section Paginacion--}}
                    {{ $productos->links('web.section.pagination-links') }}

                @endif

            </div>

            {{--Section Municipios--}}
            <div class="col-md-3">
                <div class="sidebar-box @if($ftco_animate) ftco-animate @endif">
                    <div class="categories position-relative">
                        <h3>Bodegas</h3>
                        <ul class="p-0">
                            @foreach($almacenes as $almacen)
                                <li>
                                    @if($almacen->id == $almacenes_id)
                                        <a href="#" onclick="return false;" class="color-active">
                                            {{ $almacen->nombre }} <span class="fa fa-check"></span>
                                        </a>
                                    @else
                                        <a href="#" wire:click.prevent="setAlmacen({{ $almacen->id }})">
                                            {{ $almacen->nombre }} <span class="fa fa-chevron-right"></span>
                                        </a>
                                    @endif
                                </li>
                                <!-- Spinner overlay -->
                                <div wire:loading wire:target="setAlmacen({{ $almacen->id }})" class="spinner-overlay align-content-center text-center">
                                    <div class="spinner-border color-active" role="status"></div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    @endif

</div>
