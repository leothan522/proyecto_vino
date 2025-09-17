<div class="order-lg-last btn-group mr-2">
    {{-- The Master doesn't talk, he acts. --}}

    {{--Icono Carrito--}}
    <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true"
       aria-expanded="false">
        <span class="flaticon-shopping-bag"></span>
        <div class="d-flex justify-content-center align-items-center"><small>{{ $total }}</small></div>
    </a>

    {{--Lista de Productos--}}
    <div class="dropdown-menu dropdown-menu-right">
        @foreach($items as $item)

            <div class="dropdown-item d-flex align-items-start" href="#">
                <div class="img"
                     style="background-image: url({{ verImagen($item->producto->imagen_path) }});">
                </div>
                <div class="text pl-3">
                    <h4>{{ $item->producto->nombre }}</h4>
                    <p class="mb-0">
                        <a href="{{ route('web.single', $item->productos_id) }}"
                           class="price">${{ formatoMillares($item->producto->precio) }}</a>
                        <span class="quantity ml-3">Cantidad: {{ cerosIzquierda(formatoMillares($item->cantidad, 0)) }}</span>
                    </p>
                </div>
            </div>

        @endforeach
        @if($items->isNotEmpty())
            <a class="dropdown-item text-center btn-link d-block w-100" href="{{ route('web.cart') }}">
                Ver Todo
                <span class="ion-ios-arrow-round-forward"></span>
            </a>
            @else
            <span class="dropdown-item text-center btn-link d-block w-100">Carrito Vacio</span>
        @endif
    </div>

</div>
