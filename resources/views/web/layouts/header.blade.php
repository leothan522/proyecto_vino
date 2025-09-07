<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <p class="mb-0 phone pl-md-2">
                    <a href="tel:+584144938140" class="mr-2"><span class="fa fa-phone mr-1"></span> +58 414-4938140</a>
                    <a href="#"><span class="fa fa-paper-plane mr-1"></span> espinozadiazjuliocesar287@gmail.com</a>
                </p>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">
                <div class="social-media mr-4">
                    <p class="mb-0 d-flex">
                        <a href="#" class="d-flex align-items-center justify-content-center">
                            <span class="fa fa-facebook"><i class="sr-only">Facebook</i></span>
                        </a>
                        <a href="#" class="d-flex align-items-center justify-content-center">
                            <span class="fa fa-instagram"><i class="sr-only">Instagram</i></span>
                        </a>
                    </p>
                </div>
                <div class="reg">
                    @if(Route::has('login'))
                        @auth
                            <p class="mb-0">
                                <a href="{{ isAdmin() ? uri('dashboard') : route('web.home') }}" class="mr-2">{{ auth()->user()->name }}</a>
                            </p>
                        @else
                            <p class="mb-0">
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="mr-2 d-none d-md-inline">{{ __('Register') }}</a>
                                @endif
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            </p>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
