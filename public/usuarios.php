<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Primero definimos la acción
$accion = $_GET['accion'] ?? '';

// Permitir acceso a 'crear' sin sesión
if (!isset($_SESSION['usuario_id'])) {
    if ($accion !== 'crear') {
        header('Location: login.php');
        exit;
    }
}

if ($accion !== 'crear') {
    include 'header.php';
}


switch ($accion) {
    case 'crear':
    include __DIR__ . '/../src/templates/usuarios/registro.php';
    break;
    case 'editar':
        include __DIR__ . '/../src/templates/usuarios/editar.php';
        break;
    default:
        include __DIR__ . '/../src/templates/usuarios/listar.php';
        break;
}


