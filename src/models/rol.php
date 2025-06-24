<?php
require_once __DIR__ . '/../../config/conexion.php';

class Rol {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

public function obtenerTodos() {
    $sql = "SELECT * FROM roles";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}