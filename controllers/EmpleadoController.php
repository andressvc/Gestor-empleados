<?php
require_once 'models/Empleado.php';
require_once 'models/Departamento.php';

class EmpleadoController {
    private $modelo;
    private $modeloDepartamento;

    public function __construct($db) {
        $this->modelo = new Empleado($db);
        $this->modeloDepartamento = new Departamento($db);
    }

    public function listar() {
        $empleados = $this->modelo->listar();
        $mensaje = $_GET['msg'] ?? '';
        require 'views/empleados/lista.php';
    }

    public function crear() {
        $empleado = ['id' => 0, 'codigo' => '', 'nombres' => '', 'apellidos' => '', 'fecha_nacimiento' => '', 'departamento_id' => ''];
        $this->guardar($empleado, 'Nuevo empleado', 'crear', 'Empleado creado con éxito.');
    }

    public function editar() {
        $id = (int)$_GET['id'];
        $empleado = $this->modelo->obtener($id);
        $this->guardar($empleado, 'Editar empleado', 'editar&id=' . $id, 'Empleado actualizado con éxito.');
    }

    public function eliminar() {
        $this->modelo->eliminar((int)$_POST['id']);
        $this->volver('Empleado eliminado.');
    }

    // CRUD 

    private function guardar($empleado, $titulo, $accion, $mensajeOk) {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // solo se sobreescriben los campos del formulario; id y codigo se conservan
            $empleado['nombres'] = trim($_POST['nombres'] ?? '');
            $empleado['apellidos'] = trim($_POST['apellidos'] ?? '');
            $empleado['fecha_nacimiento'] = ($_POST['fecha_nacimiento'] ?? '') ?: null;
            $empleado['departamento_id'] = $_POST['departamento_id'] ?? '';

            if ($empleado['nombres'] == '' || $empleado['apellidos'] == '' || $empleado['departamento_id'] == '') {
                $error = 'Nombres, apellidos y departamento son obligatorios.';
            } else {
                if ($empleado['id'] == 0) {
                    $this->modelo->crear($empleado['nombres'], $empleado['apellidos'], $empleado['fecha_nacimiento'], $empleado['departamento_id']);
                } else {
                    $this->modelo->actualizar($empleado['id'], $empleado['nombres'], $empleado['apellidos'], $empleado['fecha_nacimiento'], $empleado['departamento_id']);
                }
                $this->volver($mensajeOk);
            }
        }

        $departamentos = $this->modeloDepartamento->listar();
        require 'views/empleados/formulario.php';
    }

    private function volver($mensaje) {
        header('Location: index.php?c=empleado&a=listar&msg=' . urlencode($mensaje));
        exit;
    }
}