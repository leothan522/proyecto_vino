const copiarContenido = async (texto) => {
    try {
        await navigator.clipboard.writeText(texto);
        console.log('Texto copiado al portapapeles: ' + texto);
    } catch (err) {
        console.error('Error al copiar: ', err);
    }
}

