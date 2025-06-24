<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/Usuario.php';

$accion = $_GET['accion'] ?? '';
$id = $_GET['id'] ?? '';

$usuarioModel = new Usuario();

// ELIMINAR usuario
if ($accion === 'eliminar' && !empty($id)) {
    $usuarioModel->eliminar($id);
    header('Location: /sistema/public/usuarios.php');
    exit;
}

// CREAR usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $persona_id = $_POST['persona_id'] ?? '';
    $email      = $_POST['email'] ?? '';
    $password   = $_POST['password'] ?? '';
    $rol_id     = $_POST['rol_id'] ?? '';

    if (!empty($persona_id) && !empty($email) && !empty($password) && !empty($rol_id)) {
        $exito = $usuarioModel->crear($persona_id, $email, $password, $rol_id);

        if ($exito) {
            $_SESSION['mensaje'] = "Usuario registrado correctamente.";
            header('Location: /sistema/public/usuarios.php');
            exit;
        } else {
            $_SESSION['error'] = "Hubo un error al registrar el usuario.";
            header('Location: /sistema/public/usuarios.php?accion=crear');
            exit;
        }
    } else {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header('Location: /sistema/public/usuarios.php?accion=crear');
        exit;
    }
}

// ACTUALIZAR usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $id         = $_POST['id'] ?? '';
    $persona_id = $_POST['persona_id'] ?? '';
    $email      = $_POST['email'] ?? '';
    $rol_id     = $_POST['rol_id'] ?? '';

    if ($id && $persona_id && $email && $rol_id) {
        $exito = $usuarioModel->actualizar($id, $persona_id, $email, $rol_id);

        if ($exito) {
            $_SESSION['mensaje'] = "✅ Usuario actualizado correctamente.";
            header('Location: /sistema/public/usuarios.php');
            exit;
        } else {
            $_SESSION['error'] = "❌ Error al actualizar el usuario.";
            header("Location: /sistema/public/usuarios.php?accion=editar&id=" . $id);
            exit;
        }
    } else {
        $_SESSION['error'] = "⚠️ Todos los campos son obligatorios.";
        header("Location: /sistema/public/usuarios.php?accion=editar&id=" . $id);
        exit;
    }
}


