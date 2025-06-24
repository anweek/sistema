<?php
require_once __DIR__ . '/../../config/conexion.php';
class Persona {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

public function crear($nombre, $apellido, $telefono, $email) {
    $sql = "INSERT INTO personas (nombre, apellido, telefono, email) 
        VALUES (:nombre, :apellido, :telefono, :email)";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);
    if ($stmt->execute()) {
        return $this->db->lastInsertId();
    }
    return false;
}


public function obtenerTodos() {
    $sql = "SELECT id, nombre, apellido, telefono, email FROM personas"; // orden correcto
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function eliminar($id) {
    $sql = "DELETE FROM personas WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM personas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
public function obtenerIdPorNombreYApellido($nombre, $apellido) {
    $sql = "SELECT id FROM personas WHERE nombre = :nombre AND apellido = :apellido LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->execute();
    return $stmt->fetchColumn(); // Devuelve solo el ID
}


    public function actualizar($id, $nombre, $apellido, $telefono, $email) {
        $sql = "UPDATE personas SET nombre = :nombre, apellido = :apellido, telefono = :telefono, email = :email
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}