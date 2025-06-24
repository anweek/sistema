<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /sistema/public/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SISTEMA</title>
    <link rel="stylesheet" href="/sistema/src/templates/style.css"> <!-- Usa tu CSS -->
</head>
<body>
<div class="container">

    <!-- Menú lateral -->
    <div class="sidebar">
        <h2>SISTEMA</h2>
        <a href="/sistema/public/personas.php">👤 Personas</a>
        <a href="/sistema/public/proveedores.php">🏢 Proveedores</a>
        <a href="/sistema/public/usuarios.php">🔐 Usuarios</a>
        <a href="/sistema/public/categorias.php">📂 Categorías</a>

        <div style="margin-top: 20px; padding: 0 10px;">
            <form method="POST" action="/sistema/public/logout.php">
    <button type="submit" class="btn btn-logout">
        🔴 Cerrar sesión
    </button>
</form>

        </div>
    </div>

    <!-- Contenido principal -->
    <div class="main-content"> 
        <div class="header">
            <span>Bienvenido, <strong><?= htmlspecialchars($_SESSION['nombre'] ?? 'Usuario') ?></strong></span>
        </div>

