<?php
// Enrutador
require 'config/database.php';
require 'controllers/DepartamentoController.php';
require 'controllers/EmpleadoController.php';

// Función para mostrar texto de forma segura en HTML
function h($texto) {
    return htmlspecialchars((string)$texto);
}

$c = 'departamento';
if (isset($_GET['c'])) {
    $c = $_GET['c'];
}
$a = 'listar';
if (isset($_GET['a'])) {
    $a = $_GET['a'];
}

if ($c == 'empleado') {
    $controlador = new EmpleadoController($conexion);
} else {
    $controlador = new DepartamentoController($conexion);
}

if ($a == 'crear') {
    $controlador->crear();
} elseif ($a == 'editar') {
    $controlador->editar();
} elseif ($a == 'eliminar') {
    $controlador->eliminar();
} else {
    $controlador->listar();
}
