<div class="container">
    <div class="row pt-3">
        <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center"
             style="background-image: url({{ asset('img/web/about.jpg') }});background-size: contain;background-position: center;background-repeat: no-repeat;">
        </div>
        <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
            <div class="heading-section">
                <span class="subheading">Desde {{ getParametro('about_desde', 'valor_id') }}</span>
                <h2 class="mb-4">UPF Bodega de Vino Artesanal Don Juan Espinoza</h2>

                <p class="text-justify"><strong style="color: #b7472a">Visión:</strong> Con esfuerzo, pasión y dedicación aplicando las técnicas ancestrales de la vinicultura, para, producir los mejores Vinos de Venezuela. Y ser reconocidos en nuestro país como una Bodega productora de vinos de muy buena calidad en Guárico.</p>
                <p class="text-justify"><strong style="color: #b7472a">Misión:</strong> Explicar y motivar al sector publico y privado, de que el cultivo de la Uva en clima tropical, es rentable, generador de empleo directo e indirecto y es altamente productivo, de acuerdo a los estudios realizados por la Universidad Lisandro Alvarado del Estado Lara. Al desarrollar este cultivo en el estado Guárico se abrirán las puertas al mundo de la vinicultura en el país.</p>
                <p class="year">
                    <strong class="number" data-number="{{ \Carbon\Carbon::create(getParametro('about_desde', 'valor_id'))->age }}">0</strong>
                    <span>Años de experiencia en Vinos</span>
                </p>
            </div>

        </div>
    </div>
</div>
