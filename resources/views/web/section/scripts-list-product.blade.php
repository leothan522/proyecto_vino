<script !src="">

    Livewire.on('initModalLogin', ({id}) => {
        let boton = document.getElementById('buttonModalLoginFast_' + id);
        setTimeout(function () {
            boton.click();
        }, 1000);
    });

    Livewire.on('cerrarModalLoginFast', ({url, name}) => {
        let header = '<p class="mb-0"><a href="' + url + '" class="mr-2">' + name + '</a></p>';
        let footer = `
                <li><a href="{{ route('web.profile')  }}"><span class="fa fa-chevron-right mr-2"></span>{{ __('Profile') }}</a></li>
                <li><a href="{{ route('web.home') }}"><span class="fa fa-chevron-right mr-2"></span>Mis Pedidos</a></li>
            `;
        document.getElementById('cerrarModalLoginFast').click();
        //document.getElementById('headerInformacionLogin').innerHTML = header;
        document.getElementById('footerInformacionLogin').innerHTML = footer;
        document.getElementById('navbarInformacionUser').textContent = name;
    });

</script>
