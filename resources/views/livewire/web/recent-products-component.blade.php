<div class="container">
    {{-- Because she competes with no one, no one can compete with her. --}}

    @if($almacenes_id)

        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center @if($ftco_animate) ftco-animate @endif">
                <span class="subheading">Nuestras Deliciosas Ofertas en</span>
                <h2>{{ $almacen }}</h2>
            </div>
        </div>

        @if($productos->isNotEmpty())
            @include('web.section.list-products')
        @endif

        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="{{ route('web.products') }}" class="btn btn-primary d-block">Ver Todos los Productos <span class="fa fa-long-arrow-right"></span></a>
            </div>
        </div>

    @endif

</div>
