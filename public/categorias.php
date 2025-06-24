<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /sistema/public/login.php');
    exit;
}

require_once __DIR__ . '/../src/models/Categoria.php';
$categoriaModel = new Categoria();
$categorias = $categoriaModel->obtenerTodas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <link rel="stylesheet" href="/sistema/src/templates/style.css">
</head>
<body>

<div class="container">
    <!-- SIDEBAR -->
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

    <!-- CONTENIDO -->
    <div class="main-content">
        <div class="header">
            <span>Bienvenido, <strong><?= htmlspecialchars($_SESSION['nombre'] ?? 'Usuario') ?></strong></span>
        </div>

        <h2 class="titulo-lista">📂 Lista de Categorías</h2>

        <!-- FORMULARIO NUEVA CATEGORÍA -->
        <form method="POST" action="/sistema/src/controllers/categoriaController.php?accion=guardar">
            <input type="text" name="nombre" placeholder="Nueva categoría" required>
            <button type="submit" class="btn btn-agregar">➕ Agregar</button>
        </form>

        <!-- TABLA -->
        <table class="tabla-general">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $cat): ?>
                    <tr>
                        <td><?= $cat['id'] ?></td>
                        <td><?= htmlspecialchars($cat['nombre']) ?></td>
                        <td>
                            <a href="/sistema/src/controllers/categoriaController.php?accion=eliminar&id=<?= $cat['id'] ?>" 
                               onclick="return confirm('¿Eliminar esta categoría?')" 
                               class="btn btn-eliminar">
                                🗑️ Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>



