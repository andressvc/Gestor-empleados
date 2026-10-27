//Conteto caracteres
function contarCaracteres(input) {
    var maximo = input.getAttribute('maxlength');
    var contador = document.createElement('small');
    contador.className = 'contador-caracteres';
    input.parentNode.appendChild(contador);

    function actualizar() {
        var total = input.value.length;
        contador.textContent = total + '/' + maximo;

        if (total >= maximo) {
            input.classList.add('limite-caracteres');
            contador.textContent = total + '/' + maximo + ' - Límite alcanzado';
        } else {
            input.classList.remove('limite-caracteres');
        }
    }

    input.addEventListener('input', actualizar);
    actualizar();
}

var camposCaracteres = document.querySelectorAll('input[maxlength], textarea[maxlength]');
for (var i = 0; i < camposCaracteres.length; i++) {
    contarCaracteres(camposCaracteres[i]);
}
