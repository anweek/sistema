<?php 
require_once __DIR__ . '/../../config/conexion.php';

class Proveedor {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

    public function crear($nombreEmpresa, $contactoId, $telefono, $email, $direccion, $categoriaId) {
    $sql = "INSERT INTO proveedores (nombre_empresa, contacto_id, telefono, email, direccion, categoria_id)
            VALUES (:nombre_empresa, :contacto_id, :telefono, :email, :direccion, :categoria_id)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nombre_empresa', $nombreEmpresa);
    $stmt->bindParam(':contacto_id', $contactoId);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':categoria_id', $categoriaId);
    $stmt->execute();
}


    public function obtenerTodos() {
    $sql = "SELECT p.*, 
                   per.nombre AS contacto_nombre, 
                   per.apellido AS contacto_apellido,
                   c.nombre AS categoria_nombre
            FROM proveedores p
            JOIN personas per ON p.contacto_id = per.id
            LEFT JOIN categorias c ON p.categoria_id = c.id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function eliminar($id) {
        $sql = "DELETE FROM proveedores WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM proveedores WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre_empresa, $contacto_id, $telefono, $email, $direccion, $categoria_id) {
    $sql = "UPDATE proveedores 
            SET nombre_empresa = :nombre_empresa, 
                contacto_id = :contacto_id, 
                telefono = :telefono, 
                email = :email, 
                direccion = :direccion,
                categoria_id = :categoria_id
            WHERE id = :id";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre_empresa', $nombre_empresa);
    $stmt->bindParam(':contacto_id', $contacto_id);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':categoria_id', $categoria_id);

    return $stmt->execute();
}


  public function obtenerPorPersona($contacto_id) {
    $sql = "SELECT p.*, c.nombre AS contacto_nombre, c.apellido AS contacto_apellido
            FROM proveedores p
            LEFT JOIN personas c ON p.contacto_id = c.id
            WHERE p.contacto_id = :contacto_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':contacto_id', $contacto_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function contarPorCategoria() {
    $sql = "SELECT c.nombre AS categoria, COUNT(*) AS total 
            FROM proveedores p
            JOIN categorias c ON p.categoria_id = c.id
            GROUP BY c.nombre";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function buscarPorNombre($nombre) {
    $sql = "SELECT p.*, per.nombre AS contacto_nombre, per.apellido AS contacto_apellido
            FROM proveedores p
            LEFT JOIN personas per ON p.contacto_id = per.id
            WHERE p.nombre_empresa LIKE :busqueda
               OR per.nombre LIKE :busqueda
               OR per.apellido LIKE :busqueda
               OR CONCAT(per.nombre, ' ', per.apellido) LIKE :busqueda";
    
    $stmt = $this->db->prepare($sql);
    $nombre = '%' . $nombre . '%';
    $stmt->bindParam(':busqueda', $nombre, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}?>
