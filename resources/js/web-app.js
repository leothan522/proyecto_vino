window.copiarContenido = async (texto) => {
    try {
        await navigator.clipboard.writeText(texto);
        console.log('Texto copiado al portapapeles: ' + texto);
    } catch (err) {
        console.error('Error al copiar: ', err);
    }
}

/*// Oculta el loader cuando el documento esté suficientemente cargado
    document.addEventListener('readystatechange', () => {
        if (document.readyState === 'interactive') {
            // Aprox. 80% de carga: DOM listo pero recursos como imágenes aún cargando
            const loader = document.getElementById('ftco-loader');
            if (loader) {
                loader.style.display = 'none';
            }
        }
    });*/

// Fallback: si todo se carga, asegúrate de ocultarlo
window.addEventListener('load', () => {
    const loader = document.getElementById('ftco-loader');
    if (loader) {
        loader.classList.remove('show');
    }
});

//mostrar Spinner desde Livewire
window.addEventListener('showLoader', () => {
    const loader = document.getElementById('ftco-loader');
    if (loader) {
        loader.classList.add('show');
    }
});

// Ocultar el loader cuando la nueva página esté cargada
window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
        // El usuario volvió con el botón "Atrás"
        if (!document.body.classList.contains('public-page')) {
            const loader = document.getElementById('ftco-loader');
            if (loader) {
                loader.classList.remove('show');
            }
        }
    }
});




