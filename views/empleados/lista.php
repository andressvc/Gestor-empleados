<?php require 'views/header.php'; ?>

<div class="encabezado-vista">
    <h2 class="titulo-vista"><?php echo h($textoEmpleados); ?></h2>
    <a class="btn btn-primary" href="index.php?c=empleado&a=crear">+ <?php echo h($textoNuevoEmpleado); ?></a>
</div>



<?php if (empty($empleados)) { ?>
    <div class="estado-vacio">
        <p><?php echo h($textoNoHayEmpleados); ?></p>
    </div>
<?php } else { ?>
    <div class="tabla-contenedor">
        <table class="table tabla-datos">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha de nacimiento</th>
                    <th>Departamento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $e) { ?>
                <tr>
                    <td><?php echo h($e['codigo']); ?></td>
                    <td><?php echo h($e['nombres']); ?></td>
                    <td><?php echo h($e['apellidos']); ?></td>
                    <td><?php echo h($e['fecha_nacimiento']); ?></td>
                    <td><?php echo h($e['departamento']); ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="index.php?c=empleado&a=editar&id=<?php echo $e['id']; ?>">Editar</a>
                        <form method="post" action="index.php?c=empleado&a=eliminar" style="display:inline" class="form-eliminar">
                            <input type="hidden" name="id" value="<?php echo $e['id']; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php require 'views/footer.php'; ?>
