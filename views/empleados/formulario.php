<?php require 'views/header.php'; ?>

<div class="formulario-contenedor">
    <div class="card formulario-card">
        <div class="card-body">
            <h2 class="titulo-vista"><?php echo h($titulo); ?></h2>

            <?php if ($error != '') { ?>
                <div class="alert alert-danger"><?php echo h($error); ?></div>
            <?php } ?>

            <form method="post" action="index.php?c=empleado&a=<?php echo $accion; ?>" class="form-guardar">

                <?php if ($empleado['codigo'] != '') { ?>
                <div class="form-group">
                    <label>Código</label>
                    <input type="text" class="form-control" readonly value="<?php echo h($empleado['codigo']); ?>">
                </div>
                <?php } ?>

                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" name="nombres" id="nombres_empleado" class="form-control" maxlength="100" required
                           value="<?php echo h($empleado['nombres']); ?>">
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos_empleado" class="form-control" maxlength="100" required
                           value="<?php echo h($empleado['apellidos']); ?>">
                </div>
                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control"
                           value="<?php echo h($empleado['fecha_nacimiento']); ?>">
                </div>
                <div class="form-group">
                    <label>Departamento</label>
                    <select name="departamento_id" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <?php foreach ($departamentos as $d) { ?>
                            <?php
                            $seleccionado = '';
                            if ($d['id'] == $empleado['departamento_id']) {
                                $seleccionado = 'selected';
                            }
                            ?>
                            <option value="<?php echo $d['id']; ?>" <?php echo $seleccionado; ?>>
                                <?php echo h($d['nombre']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a class="btn btn-secondary" href="index.php?c=empleado&a=listar">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<script>
    //Validación de espacios
    function noEspacioAlInicio(input) {
        input.addEventListener('keydown', function(e) {
            if (e.key === ' ' && input.value.length === 0) {
                e.preventDefault();
            }
        });
    }

    //Validación para textbox1
    function evitarIgualPuntoComa(input) {
        input.addEventListener('keypress', function(e) {
            if (e.key === '=' || e.key === ';') {
                e.preventDefault();
            }
        });
    }

    //Validación textbox2
    function soloLetrasYTildes(input) {
        input.addEventListener('keypress', function(e) {
            var letra = e.key;
            var regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]$/;
            if (!regex.test(letra)) {
                e.preventDefault();
            }
        });
    }

    var inputNombres = document.getElementById('nombres_empleado');
    var inputApellidos = document.getElementById('apellidos_empleado');
    if (inputNombres) {
        noEspacioAlInicio(inputNombres);
        soloLetrasYTildes(inputNombres);
        evitarIgualPuntoComa(inputNombres);
    }
    if (inputApellidos) {
        noEspacioAlInicio(inputApellidos);
        soloLetrasYTildes(inputApellidos);
        evitarIgualPuntoComa(inputApellidos);
    }
</script>

<?php require 'views/footer.php'; ?>
