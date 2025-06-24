<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
require_once __DIR__ . '/../models/Usuario.php';

$usuarioModel = new Usuario();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuario = $usuarioModel->obtenerPorEmail($email);

    if ($usuario && password_verify($password, $usuario['contrasena'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['rol_id'] = $usuario['rol_id'];
    header('Location: ../../public/proveedores.php');
    
require_once __DIR__ . '/../models/Persona.php';
$personaModel = new Persona();
$persona = $personaModel->obtenerPorId($usuario['persona_id']);

$_SESSION['nombre'] = $persona['nombre'] . ' ' . $persona['apellido'];


$_SESSION['nombre'] = $usuarioModel->obtenerNombrePorUsuario($usuario['id']);


        // Redirige a proveedores.php después del login exitoso
        header('Location: ../../public/proveedores.php');
        exit;
    } else {
        echo "Credenciales incorrectas.";
    }
}
