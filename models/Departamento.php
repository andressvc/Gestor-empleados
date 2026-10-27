<?php
class Departamento {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listar() {
        $stmt = $this->db->query("SELECT * FROM departamentos ORDER BY nombre");
        return $stmt->fetchAll();
    }

    public function obtener($id) {
        $stmt = $this->db->prepare("SELECT * FROM departamentos WHERE id = ?");
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Devuelve true si el codigo ya lo usa OTRO departamento
    public function existeCodigo($codigo, $idActual) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM departamentos WHERE codigo = ? AND id <> ?");
        $stmt->execute(array($codigo, $idActual));
        return $stmt->fetchColumn() > 0;
    }

    public function tieneEmpleados($id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM empleados WHERE departamento_id = ?");
        $stmt->execute(array($id));
        return $stmt->fetchColumn() > 0;
    }

    public function crear($codigo, $nombre, $descripcion) {
        $stmt = $this->db->prepare("INSERT INTO departamentos (codigo, nombre, descripcion) VALUES (?, ?, ?)");
        $stmt->execute(array($codigo, $nombre, $descripcion));
    }

    public function actualizar($id, $codigo, $nombre, $descripcion) {
        $stmt = $this->db->prepare("UPDATE departamentos SET codigo = ?, nombre = ?, descripcion = ? WHERE id = ?");
        $stmt->execute(array($codigo, $nombre, $descripcion, $id));
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM departamentos WHERE id = ?");
        $stmt->execute(array($id));
    }
}
