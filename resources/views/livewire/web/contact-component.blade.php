<div class="container">
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="wrapper px-md-4">

                <div class="row mb-5">
                    <div class="col-md-3">
                        <div class="dbox w-100 text-center">
                            <div class="icon d-none d-md-flex align-items-center justify-content-center">
                                <span class="fa fa-map-marker"></span>
                            </div>
                            <div class="text">
                                <p class="text-justify"><span>Dirección:</span> {{ getParametro('contact_direccion') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dbox w-100 text-center">
                            <div class="icon d-none d-md-flex align-items-center justify-content-center">
                                <span class="fa fa-phone"></span>
                            </div>
                            <div class="text">
                                <p class="text-justify text-md-center"><span>Teléfono:</span> <a href="tel:{{ Str::replace([' ', '-'], '', getParametro('contact_telefono')) }}">{{ getParametro('contact_telefono') }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dbox w-100 text-center">
                            <div class="icon d-none d-md-flex align-items-center justify-content-center">
                                <span class="fa fa-paper-plane"></span>
                            </div>
                            <div class="text">
                                <p class="text-justify text-md-center"><span>Email:</span> <a href="mailto:{{ Str::replace(' ', '', Str::lower(getParametro('contact_email'))) }}">{{ Str::lower(getParametro('contact_email')) }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dbox w-100 text-center">
                            <div class="icon d-none d-md-flex align-items-center justify-content-center">
                                <span class="fa fa-globe"></span>
                            </div>
                            <div class="text">
                                <p class="text-justify text-md-center"><span>Sitio Web:</span> <a href="{{ route('web.index') }}">{{ getParametro('contact_web') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row no-gutters justify-content-center">

                    <div class="col-md-7">
                        <div class="contact-wrap w-100 p-md-5 p-4">
                            <h3 class="mb-4">Contáctenos</h3>
                            <form wire:submit="sendMessage" id="contactForm" name="contactForm" class="contactForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label" for="name">Nombre Completo</label>
                                            <input type="text" wire:model="nombre" class="form-control" id="name" placeholder="Nombre">
                                            @error('nombre')
                                            <small class="text-primary">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label" for="email">{{ __('Email') }}</label>
                                            <input type="email" wire:model="email" class="form-control" id="email" placeholder="{{ __('Email') }}">
                                            @error('email')
                                            <small class="text-primary">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="subject">Asunto</label>
                                            <input type="text" wire:model="asunto" class="form-control" id="subject" placeholder="Asunto">
                                            @error('asunto')
                                            <small class="text-primary">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="#">Mensaje</label>
                                            <textarea wire:model="mensaje" class="form-control" id="message" cols="30" rows="4" placeholder="Mensaje"></textarea>
                                            @error('mensaje')
                                            <small class="text-primary">{{ $message }}</small>
                                            @enderror
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
                            <!-- Spinner overlay -->
                            <div wire:loading wire:target="sendMessage" class="spinner-overlay align-content-center text-center">
                                <div class="spinner-border color-active" role="status"></div>
                            </div>
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
