<div class="container">
    {{-- Stop trying to control. --}}

    @if($imagenes->isNotEmpty())

        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center @if($ftco_animate) ftco-animate @endif">
                <span class="subheading">Galería</span>
                <h2>Galería Reciente</h2>
            </div>
        </div>

        @include('web.section.list-imagenes')

    @endif

</div>
