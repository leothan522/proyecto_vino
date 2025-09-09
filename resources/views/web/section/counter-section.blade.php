<section class="ftco-counter ftco-section ftco-no-pt ftco-no-pb img bg-light" id="section-counter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18 py-4 mb-4">
                    <div class="text align-items-center">
                        <strong class="number" data-number="{{ getParametro('about_clientes', 'valor_id') }}">0</strong>
                        <span>Clientes Satisfechos</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18 py-4 mb-4">
                    <div class="text align-items-center">
                        <strong class="number" data-number="{{ \Carbon\Carbon::create(getParametro('about_desde', 'valor_id'))->age }}">0</strong>
                        <span>Años de experiencia</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18 py-4 mb-4">
                    <div class="text align-items-center">
                        <strong class="number" data-number="5">0</strong>
                        <span>Tipos de Vinos</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18 py-4 mb-4">
                    <div class="text align-items-center">
                        <strong class="number" data-number="1">0</strong>
                        <span>Nuestras Bodegas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
