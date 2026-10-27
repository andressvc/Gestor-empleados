<?php
require_once 'models/Departamento.php';

class DepartamentoController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Departamento($db);
    }

    public function listar() {
        $departamentos = $this->modelo->listar();
        $mensaje = $_GET['msg'] ?? '';
        require 'views/departamentos/lista.php';
    }

    public function crear() {
        $departamento = ['id' => 0, 'codigo' => '', 'nombre' => '', 'descripcion' => ''];
        $this->guardar($departamento, 'Nuevo departamento', 'crear', 'Departamento creado.');
    }

    public function editar() {
        $id = (int)$_GET['id'];
        $departamento = $this->modelo->obtener($id);
        if (!$departamento) {
            $this->volver('El departamento no existe.');
        }
        $this->guardar($departamento, 'Editar departamento', 'editar&id=' . $id, 'Departamento actualizado.');
    }

    public function eliminar() {
        $id = (int)$_POST['id'];

        if ($this->modelo->tieneEmpleados($id)) {
            $this->volver('No se puede eliminar: el departamento tiene empleados.');
        }

        $this->modelo->eliminar($id);
        $this->volver('Departamento eliminado.');
    }

    // CRUD

    private function guardar($departamento, $titulo, $accion, $mensajeOk) {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $departamento['codigo'] = trim($_POST['codigo'] ?? '');
            $departamento['nombre'] = trim($_POST['nombre'] ?? '');
            $departamento['descripcion'] = trim($_POST['descripcion'] ?? '');

            $error = $this->validar($departamento);

            if ($error == '') {
                if ($departamento['id'] == 0) {
                    $this->modelo->crear($departamento['codigo'], $departamento['nombre'], $departamento['descripcion']);
                } else {
                    $this->modelo->actualizar($departamento['id'], $departamento['codigo'], $departamento['nombre'], $departamento['descripcion']);
                }
                $this->volver($mensajeOk);
            }
        }

        require 'views/departamentos/formulario.php';
    }

    private function validar($departamento) {
        if ($departamento['codigo'] == '' || $departamento['nombre'] == '') {
            return 'El código y el nombre son obligatorios.';
        }
        if ($this->modelo->existeCodigo($departamento['codigo'], $departamento['id'])) {
            return 'El código ya existe. Use otro código.';
        }
        return '';
    }

    private function volver($mensaje) {
        header('Location: index.php?c=departamento&a=listar&msg=' . urlencode($mensaje));
        exit;
    }
}