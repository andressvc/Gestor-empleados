<?php
class Empleado {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listar() {
        $sql = "SELECT e.id, e.codigo, e.nombres, e.apellidos, DATE_FORMAT(e.fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento, e.departamento_id, d.nombre AS departamento
                FROM empleados e
                INNER JOIN departamentos d ON d.id = e.departamento_id
                ORDER BY e.codigo";
        return $this->db->query($sql)->fetchAll();
    }

    public function obtener($id) {
        $stmt = $this->db->prepare("SELECT * FROM empleados WHERE id = ?");
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Genera EMP-000
    private function generarCodigo() {
        $stmt = $this->db->query("SELECT codigo FROM empleados ORDER BY codigo DESC LIMIT 1");
        $ultimo = $stmt->fetchColumn();

        if ($ultimo == false) {
            $numero = 1;
        } else {
            $numero = (int)substr($ultimo, 4) + 1;
        }
        return 'EMP-' . str_pad($numero, 4, '0', STR_PAD_LEFT);
    }

    public function crear($nombres, $apellidos, $fecha, $departamentoId) {
        $codigo = $this->generarCodigo();
        $stmt = $this->db->prepare("INSERT INTO empleados (codigo, nombres, apellidos, fecha_nacimiento, departamento_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($codigo, $nombres, $apellidos, $fecha, $departamentoId));
    }

    // El codigo no se actualiza nunca
    public function actualizar($id, $nombres, $apellidos, $fecha, $departamentoId) {
        $stmt = $this->db->prepare("UPDATE empleados SET nombres = ?, apellidos = ?, fecha_nacimiento = ?, departamento_id = ? WHERE id = ?");
        $stmt->execute(array($nombres, $apellidos, $fecha, $departamentoId, $id));
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM empleados WHERE id = ?");
        $stmt->execute(array($id));
    }
}
