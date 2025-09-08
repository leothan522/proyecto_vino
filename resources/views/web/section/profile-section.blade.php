<section class="ftco-section">
    <div class="container">
        <div class="row">
            {{--Content home--}}
            <div class="col-md-10 order-last">

                {{--Profile--}}
                <div class="ftco-animate" id="div_profile">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')

                            <x-section-border/>
                        @endif

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.update-password-form')
                            </div>

                            <x-section-border/>
                        @endif

                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.two-factor-authentication-form')
                            </div>

                            <x-section-border/>
                        @endif

                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <x-section-border/>

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.delete-user-form')
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{--Menu Home--}}
            <div class="col-md-2">

                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Gestionar</h3>
                        <ul class="p-0">
                            <li><a href="{{ route('web.home') }}">Mis Pedidos <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="{{ route('web.home', 'datos-facturacion') }}">Datos de Facturación <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="{{ route('web.profile') }}" class="color-active">{{ __('Profile') }} <span class="fa fa-chevron-right color-active"></span></a></li>
                            <li>
                                <a href="#" onclick="document.getElementById('form_logout').submit(); return false">
                                    {{ __('Logout') }} <span class="fa fa-chevron-right"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" id="form_logout">
                    @csrf
                </form>

            </div>
        </div>
    </div>
</section>
