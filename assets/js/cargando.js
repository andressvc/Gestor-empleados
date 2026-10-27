// Referencia a la pantalla de carga
function obtenerPantallaCargando() {
    return document.getElementById('pantallaCargando');
}

// Función para mostrar la pantalla de carga
function mostrarCargando() {
    var pantalla = obtenerPantallaCargando();
    if (pantalla != null) {
        pantalla.classList.add('visible');
    }
}

// Función para ocultar la pantalla de carga
function ocultarCargando() {
    var pantalla = obtenerPantallaCargando();
    if (pantalla != null) {
        pantalla.classList.remove('visible');
    }
}

window.addEventListener('load', function () {
    ocultarCargando();
});

window.addEventListener('pageshow', function () {
    ocultarCargando();
});
