var formularioPendiente = null;

// Confirmar al guardar o eliminar
document.addEventListener('submit', function(e) {
    var form = e.target;
    if (form.classList && form.classList.contains('form-guardar')) {
        e.preventDefault();
        formularioPendiente = form;
        mostrarModal('¿Seguro que desea guardar?', true);
        return;
    }
    if (form.classList && form.classList.contains('form-eliminar')) {
        e.preventDefault();
        formularioPendiente = form;
        mostrarModal('¿Seguro que desea eliminar?', true);
        return;
    }
});

function mostrarModal(texto, confirmar) {
    var modal = document.getElementById('modalSimple');
    var txt = document.getElementById('modalSimpleTexto');
    var botones = document.getElementById('modalSimpleBotones');
    var btnOk = document.getElementById('btnModalOk');

    if (modal && txt) {
        txt.innerHTML = texto;
        modal.style.display = 'flex';

        if (confirmar) {
            if (botones) botones.style.display = 'block';
            if (btnOk) btnOk.style.display = 'none';
        } else {
            if (botones) botones.style.display = 'none';
            if (btnOk) btnOk.style.display = 'inline-block';
        }
    }
}

function limpiarParametros() {
    var url = window.location.search;
    if (url.indexOf('guardado=1') !== -1 || url.indexOf('editado=1') !== -1 || url.indexOf('eliminado=1') !== -1 || url.indexOf('msg=') !== -1) {
        var c = obtenerValor('c');
        var a = obtenerValor('a');
        if (c == '') {
            c = 'departamento';
        }
        if (a == '') {
            a = 'listar';
        }
        history.replaceState({}, document.title, 'index.php?c=' + c + '&a=listar');
    }
}

function obtenerValor(nombre) {
    var url = window.location.search.substring(1);
    var params = url.split('&');
    for (var i = 0; i < params.length; i++) {
        var par = params[i].split('=');
        if (par[0] == nombre) {
            return par[1];
        }
    }
    return '';
}

window.addEventListener('load', function() {
    var btnSi = document.getElementById('btnModalSi');
    var btnNo = document.getElementById('btnModalNo');
    var btnOk = document.getElementById('btnModalOk');
    var modal = document.getElementById('modalSimple');

    if (btnSi) {
        btnSi.onclick = function() {
            if (modal) {
                modal.style.display = 'none';
            }
            if (formularioPendiente) {
                if (typeof mostrarCargando == 'function') {
                    mostrarCargando();
                }
                formularioPendiente.submit();
                formularioPendiente = null;
            }
        };
    }

    if (btnNo) {
        btnNo.onclick = function() {
            if (modal) {
                modal.style.display = 'none';
            }
            formularioPendiente = null;
        };
    }

    if (btnOk) {
        btnOk.onclick = function() {
            if (modal) {
                modal.style.display = 'none';
            }
        };
    }

    var url = window.location.search;

    if (url.indexOf('guardado=1') !== -1) {
        mostrarModal('Guardado correctamente', false);
        limpiarParametros();
        return;
    }

    if (url.indexOf('editado=1') !== -1) {
        mostrarModal('Empleado actualizado exitosamente', false);
        limpiarParametros();
        return;
    }

    if (url.indexOf('eliminado=1') !== -1) {
        mostrarModal('Eliminado correctamente', false);
        limpiarParametros();
        return;
    }

    if (url.indexOf('msg=') !== -1) {
        var parte = url.split('msg=')[1];
        var texto = parte.split('&')[0];
        texto = decodeURIComponent(texto);
        texto = texto.replace(/\+/g, ' ');
        mostrarModal(texto, false);
        limpiarParametros();
        return;
    }
});
