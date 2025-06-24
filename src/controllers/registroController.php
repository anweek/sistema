<?php
session_start();
require_once __DIR__ . '/../models/persona.php';
require_once __DIR__ . '/../models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_usuario'])) {
    $nombre     = $_POST['nombre'] ?? '';
    $apellido   = $_POST['apellido'] ?? '';
    $telefono   = $_POST['telefono'] ?? '';
    $emailPer   = $_POST['email_persona'] ?? '';
    $emailUser  = $_POST['email_usuario'] ?? '';
    $password   = $_POST['password'] ?? '';
    $rol_id     = $_POST['rol_id'] ?? '';

    if ($nombre && $apellido && $telefono && $emailPer && $emailUser && $password && $rol_id) {
        $personaModel = new Persona();
        $persona_id = $personaModel->crear($nombre, $apellido, $telefono, $emailPer);

        if ($persona_id) {
            $usuarioModel = new Usuario();
            $exito = $usuarioModel->crear($persona_id, $emailUser, $password, $rol_id);

            if ($exito) {
                $_SESSION['mensaje'] = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
                header('Location: /sistema/public/login.php');
                exit;
            } else {
                $_SESSION['error'] = "Error al crear el usuario.";
            }
        } else {
            $_SESSION['error'] = "Error al crear la persona.";
        }
    } else {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
    }

    header('Location: /sistema/public/usuarios.php?accion=crear');
    exit;
}