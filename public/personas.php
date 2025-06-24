<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$accion = $_GET['accion'] ?? '';

// ✅ Permitir crear sin sesión
if (!isset($_SESSION['usuario_id']) && $accion !== 'crear' && $accion !== 'guardar') {
    header('Location: login.php');
    exit;
}

// Solo incluir el header si hay sesión activa
if (isset($_SESSION['usuario_id'])) {
    include 'header.php';
}

require_once __DIR__ . '/../src/models/persona.php';

switch ($accion) {
    case 'crear':
        include __DIR__ . '/../src/templates/personas/crear.php';
        break;

    case 'guardar':
        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $email = $_POST['email'] ?? '';

        $persona = new Persona();
        $persona->crear($nombre, $apellido, $telefono, $email);

        // Redirige según si hay sesión o no
        if (isset($_SESSION['usuario_id'])) {
            header('Location: personas.php');
        } else {
            header('Location: /sistema/public/usuarios.php?accion=crear');
        }
        exit;

    case 'editar':
        include __DIR__ . '/../src/templates/personas/editar.php';
        break;

    default:
        include __DIR__ . '/../src/templates/personas/listar.php';
        break;
}
?>
