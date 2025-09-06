<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper px-md-4">
                    <div class="row mb-5">
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="text">
                                    <p><span>Dirección:</span> Urbanización Rómulo Gallegos sector 2 vereda 15 casa número 8, San Juan de los Morros, Guárico, Venezuela</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="text">
                                    <p><span>Teléfono:</span> <a href="tel:+584144938140">+58 414-4938140</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-paper-plane"></span>
                                </div>
                                <div class="text">
                                    <p><span>Email:</span> <a href="mailto:espinozadiazjuliocesar287@gmail.com">espinozadiazjuliocesar287@gmail.com</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-globe"></span>
                                </div>
                                <div class="text">
                                    <p><span>Sitio web</span> <a href="{{ route('web.index') }}">vinoguariqueño.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters justify-content-center">

                        <div class="col-md-7">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Contáctenos</h3>
                                <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="name">Nombre Completo</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="email">{{ __('Email') }}</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('Email') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="subject">Asunto</label>
                                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="#">Mensaje</label>
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Mensaje"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Enviar Mensaje" class="btn btn-primary">
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-5 order-md-first d-none <!--d-flex--> align-items-stretch">
                            <div id="map" class="map"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
