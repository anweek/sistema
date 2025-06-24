<?php
require_once __DIR__ . '/../../config/conexion.php';


class Categoria {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

    public function obtenerTodas() {
    $stmt = $this->db->prepare("SELECT * FROM categorias");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function crear($nombre) {
        $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM categorias WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

