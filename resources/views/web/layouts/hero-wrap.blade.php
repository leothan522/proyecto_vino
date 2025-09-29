<div class="hero-wrap d-none d-md-block" style="background-image: url('{{ asset('img/web/hero.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-8 ftco-animate d-flex align-items-end">
                <div class="text w-100 text-center">
                    <h1 class="mb-4">Buena <span>Bebida</span> para buenos <span>Momentos</span>.</h1>
                    <p x-data>
                        <a href="{{ route('web.products') }}" @click="window.dispatchEvent(new CustomEvent('showLoader'));" class="btn btn-primary py-2 px-4">Comprar Ahora</a>
                        <a href="{{ route('web.blog') }}" @click="window.dispatchEvent(new CustomEvent('showLoader'));"  class="btn btn-white btn-outline-white py-2 px-4">Leer más</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
