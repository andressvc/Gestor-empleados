<?php require 'views/header.php'; ?>

<div class="encabezado-vista">
    <h2 class="titulo-vista"><?php echo h($textoDepartamentos); ?></h2>
    <a class="btn btn-primary" href="index.php?c=departamento&a=crear">+ <?php echo h($textoNuevoDepartamento); ?></a>
</div>



<?php if (empty($departamentos)) { ?>
    <div class="estado-vacio">
        <p><?php echo h($textoNoHayDepartamentos); ?></p>
    </div>
<?php } else { ?>
    <div class="tabla-contenedor">
        <table class="table tabla-datos">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departamentos as $d) { ?>
                <tr>
                    <td><?php echo h($d['codigo']); ?></td>
                    <td><?php echo h($d['nombre']); ?></td>
                    <td><?php echo h($d['descripcion']); ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="index.php?c=departamento&a=editar&id=<?php echo $d['id']; ?>">Editar</a>
                        <form method="post" action="index.php?c=departamento&a=eliminar" style="display:inline" class="form-eliminar">
                            <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
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
