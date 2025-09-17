<footer class="ftco-footer d-none d-md-block">
    <div class="container">
        <div class="row mb-5">
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 logo"><a href="{{ route('web.index') }}">Vino <span>Don Juan Espinoza</span></a></h2>
                    <p class="d-none">Far far away, behind the word mountains, far from the countries.</p>
                    <ul class="ftco-footer-social list-unstyled mt-2">
                        <li class="ftco-animate"><a href="{{ Str::replace(' ', '', getParametro('social_facebook')) }}" target="_blank"><span class="fa fa-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="{{ Str::replace(' ', '', getParametro('social_instagram')) }}" target="_blank"><span class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Mi Cuenta</h2>
                    <ul id="footerInformacionLogin" class="list-unstyled">
                        @auth
                            <li><a href="{{ route('web.profile')  }}"><span class="fa fa-chevron-right mr-2"></span>{{ __('Profile') }}</a></li>
                            <li><a href="{{ route('web.home') }}"><span class="fa fa-chevron-right mr-2"></span>Mis Pedidos</a></li>
                        @else
                            <li><a href="{{ route('register') }}"><span class="fa fa-chevron-right mr-2"></span>{{ __('Register') }}</a></li>
                            <li><a href="{{ route('login') }}"><span class="fa fa-chevron-right mr-2"></span>{{ __('Log In') }}</a></li>
                        @endauth
                            <li><a href="{{ route('filament.dashboard.pages.dashboard') }}"><span class="fa fa-chevron-right mr-2"></span>{{ __('Dashboard') }}</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Información</h2>
                    <ul class="list-unstyled">
                        <li><a href="tel:{{ Str::replace([' ', '-'], '', getParametro('contact_telefono')) }}"><span class="icon fa fa-phone pr-4"></span><span class="text">{{ getParametro('contact_telefono') }}</span></a></li>
                        <li><a href="mailto:{{ Str::replace(' ', '', Str::lower(getParametro('contact_email'))) }}"><span class="icon fa fa-paper-plane pr-4"></span><span class="text">{{ Str::lower(getParametro('contact_email')) }}</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md d-none">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Quick Link</h2>
                    <ul class="list-unstyled">
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>New User</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Help Center</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Report Spam</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Faq's</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">¿Donde Ubicarnos?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li>
                                <span class="icon fa fa-map marker"></span>
                                <span class="text">{{ getParametro('contact_direccion') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-0 py-5 bg-black">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <p class="mb-0" style="color: rgba(255,255,255,.5);">
                        &copy;<script>document.write(new Date().getFullYear());</script>
                        {{ getParametro('contact_nombre') }} RIF {{ getParametro('contact_rif') }}
                        <span class="d-none d-md-inline float-right">
                            <i class="fa fa-heart color-danger" aria-hidden="true"></i> Dev.
                            <a href="https://t.me/Leothan" target="_blank">Yonathan Castillo</a>
                        </span>
                    </p>

                    <p class="mb-0 d-none" style="color: rgba(255,255,255,.5);">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        All rights reserved | This template is made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by
                        <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<footer class="d-md-none">
    <div class="container-fluid px-0 py-5 bg-black">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <p class="mb-0" style="color: rgba(255,255,255,.5);">
                        &copy;<script>document.write(new Date().getFullYear());</script>
                        {{ getParametro('contact_nombre') }} RIF {{ getParametro('contact_rif') }}
                        <span class="d-none d-md-inline float-right">
                            <i class="fa fa-heart color-danger" aria-hidden="true"></i> Dev.
                            <a href="https://t.me/Leothan" target="_blank">Yonathan Castillo</a>
                        </span>
                    </p>

                    <p class="mb-0 d-none" style="color: rgba(255,255,255,.5);">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        All rights reserved | This template is made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by
                        <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
