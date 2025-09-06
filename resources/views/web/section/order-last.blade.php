<div class="order-lg-last btn-group">
    <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="flaticon-shopping-bag"></span>
        <div class="d-flex justify-content-center align-items-center"><small>2</small></div>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-item d-flex align-items-start" href="#">
            <div class="img" style="background-image: url({{ asset('vendor/liquorstore/images/prod-1.jpg') }});"></div>
            <div class="text pl-3">
                <h4>Bacardi 151</h4>
                <p class="mb-0">
                    <a href="{{ route('web.single', 1) }}" class="price">$25.99</a>
                    <span class="quantity ml-3">Cantidad: 01</span>
                </p>
            </div>
        </div>
        <div class="dropdown-item d-flex align-items-start" href="#">
            <div class="img"
                 style="background-image: url({{ asset('vendor/liquorstore/images/prod-2.jpg') }});"></div>
            <div class="text pl-3">
                <h4>Jim Beam Kentucky Straight</h4>
                <p class="mb-0">
                    <a href="{{ route('web.single', 2) }}" class="price">$30.89</a>
                    <span class="quantity ml-3">Cantidad: 02</span></p>
            </div>
        </div>
        <div class="dropdown-item d-flex align-items-start" href="#">
            <div class="img"
                 style="background-image: url({{ asset('vendor/liquorstore/images/prod-3.jpg') }});"></div>
            <div class="text pl-3">
                <h4>Citadelle</h4>
                <p class="mb-0">
                    <a href="{{ route('web.single', 3) }}" class="price">$22.50</a>
                    <span class="quantity ml-3">Cantidad: 01</span>
                </p>
            </div>
        </div>
        <a class="dropdown-item text-center btn-link d-block w-100" href="{{ route('web.cart') }}">
            Ver Todo
            <span class="ion-ios-arrow-round-forward"></span>
        </a>
    </div>
</div>
