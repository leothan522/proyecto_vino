window.copiarContenido = async (texto) => {
    try {
        await navigator.clipboard.writeText(texto);
        console.log('Texto copiado al portapapeles: ' + texto);
    } catch (err) {
        console.error('Error al copiar: ', err);
    }
}

$('.image-popup-individual').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
    gallery: {
        enabled: false,
    },
    image: {
        verticalFit: true
    },
    zoom: {
        enabled: true,
        duration: 300 // don't foget to change the duration also in CSS
    }
});

