<?php
// Títulos y textos repetidos
$tituloSistema = 'Control de empleados';
$textoDepartamentos = 'Departamentos';
$textoEmpleados = 'Empleados';
$textoNuevoDepartamento = 'Nuevo departamento';
$textoNuevoEmpleado = 'Nuevo empleado';
$textoNoHayDepartamentos = 'No hay departamentos registrados';
$textoNoHayEmpleados = 'No hay empleados registrados';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo h($tituloSistema); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <?php require_once 'views/componentes/cargando.php'; ?>

    <nav class="navbar navbar-personalizada mb-4">
        <div class="container d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
            <span class="navbar-brand"><?php echo h($tituloSistema); ?></span>
            <div class="menu-navegacion">
                <?php
                $controladorActivo = isset($_GET['c']) ? $_GET['c'] : 'departamento';
                $claseDepartamento = ($controladorActivo == 'departamento') ? ' enlace-menu activo' : ' enlace-menu';
                $claseEmpleado = ($controladorActivo == 'empleado') ? ' enlace-menu activo' : ' enlace-menu';
                ?>
                <a class="<?php echo $claseDepartamento; ?>" href="index.php?c=departamento&a=listar"><?php echo h($textoDepartamentos); ?></a>
                <a class="<?php echo $claseEmpleado; ?>" href="index.php?c=empleado&a=listar"><?php echo h($textoEmpleados); ?></a>
            </div>
        </div>
    </nav>

    <?php //Modal ?>
    <div id="modalSimple" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:99999; align-items:center; justify-content:center;">
        <div style="background:#fff; padding:25px 30px; border:1px solid #ccc; border-radius:6px; min-width:340px; max-width:420px; text-align:center;">
            <div id="modalSimpleTexto" style="margin-bottom:18px; font-size:16px;"></div>
            <div id="modalSimpleBotones">
                <button type="button" id="btnModalSi" class="btn btn-sm btn-success">Aceptar</button>
                <button type="button" id="btnModalNo" class="btn btn-sm btn-secondary">Cancelar</button>
            </div>
            <button type="button" id="btnModalOk" class="btn btn-sm btn-success" style="display:none;">Aceptar</button>
        </div>
    </div>

    <main class="container contenido-principal">
