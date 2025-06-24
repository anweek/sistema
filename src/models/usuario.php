<?php
require_once __DIR__ . '/../../config/conexion.php';

class Usuario {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConexion();
    }

  public function crear($persona_id, $email, $password, $rol_id) {
    $sql = "INSERT INTO usuarios (persona_id, email, contrasena, rol_id) VALUES (?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    return $stmt->execute([$persona_id, $email, $hashed, $rol_id]);
}



    public function obtenerTodos() {
    $sql = "SELECT u.id, u.email, u.rol_id, u.persona_id, 
                   r.nombre AS rol_nombre,
                   p.nombre AS persona_nombre,
                   p.apellido AS persona_apellido
            FROM usuarios u
            LEFT JOIN roles r ON u.rol_id = r.id
            LEFT JOIN personas p ON u.persona_id = p.id";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function eliminar($id) {
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}



    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $persona_id, $email, $rol_id) {
    $sql = "UPDATE usuarios SET persona_id = :persona_id, email = :email, rol_id = :rol_id WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':persona_id', $persona_id);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':rol_id', $rol_id);
    return $stmt->execute();
}

public function obtenerNombrePorUsuario($id) {
    $sql = "SELECT p.nombre FROM usuarios u
            JOIN personas p ON u.persona_id = p.id
            WHERE u.id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchColumn();
}

    
public function obtenerPorEmail($email) {
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function verificarLogin($email, $password) {
    $sql = "SELECT u.*, p.nombre, p.apellido 
            FROM usuarios u 
            JOIN personas p ON u.persona_id = p.id 
            WHERE u.email = :email 
            LIMIT 1";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && isset($usuario['contrasena']) && password_verify($password, $usuario['contrasena'])) {
        return $usuario;
    }

    return false;
}


}
