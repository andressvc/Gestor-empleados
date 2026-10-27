<?php require 'views/header.php'; ?>

<div class="formulario-contenedor">
    <div class="card formulario-card">
        <div class="card-body">
            <h2 class="titulo-vista"><?php echo h($titulo); ?></h2>

            <?php if ($error != '') { ?>
                <div class="alert alert-danger"><?php echo h($error); ?></div>
            <?php } ?>

            <form method="post" action="index.php?c=departamento&a=<?php echo $accion; ?>" class="form-guardar">
                <div class="form-group">
                    <label>Código</label>
                    <input type="text" name="codigo" id="codigo_departamento" class="form-control" maxlength="20" required
                           value="<?php echo h($departamento['codigo']); ?>">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="nombre_departamento" class="form-control" maxlength="100" required
                           value="<?php echo h($departamento['nombre']); ?>">
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" id="descripcion_departamento" class="form-control" maxlength="255"><?php echo h($departamento['descripcion']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a class="btn btn-secondary" href="index.php?c=departamento&a=listar">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<script>
    //Validacion de espacios
    function noEspacioAlInicio(input) {
        input.addEventListener('keydown', function(e) {
            if (e.key === ' ' && input.value.length === 0) {
                e.preventDefault();
            }
        });
    }

    //Validacion para evitar = y ;
    function evitarIgualPuntoComa(input) {
        input.addEventListener('keypress', function(e) {
            if (e.key === '=' || e.key === ';') {
                e.preventDefault();
            }
        });
    }

    //Validacion de tildes
    function soloLetrasYTildes(input) {
        input.addEventListener('keypress', function(e) {
            var letra = e.key;
            var regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]$/;
            if (!regex.test(letra)) {
                e.preventDefault();
            }
        });
    }

    var inputCodigo = document.getElementById('codigo_departamento');
    var inputNombreDep = document.getElementById('nombre_departamento');
    var inputDescripcionDep = document.getElementById('descripcion_departamento');
    if (inputCodigo) {
        noEspacioAlInicio(inputCodigo);
        evitarIgualPuntoComa(inputCodigo);
    }
    if (inputNombreDep) {
        noEspacioAlInicio(inputNombreDep);
        soloLetrasYTildes(inputNombreDep);
        evitarIgualPuntoComa(inputNombreDep);
    }
    if (inputDescripcionDep) {
        noEspacioAlInicio(inputDescripcionDep);
        evitarIgualPuntoComa(inputDescripcionDep);
    }
</script>

<?php require 'views/footer.php'; ?>
