<?php
require_once __DIR__ . '/../../models/usuario.php';
$usuarioModel = new Usuario();
$usuarios = $usuarioModel->obtenerTodos();
?>

<div class="content">
    <h2 class="titulo-lista">👤 Lista de Usuarios</h2>

    <!-- Botón para agregar nuevo usuario -->
    <div class="acciones-superiores">
        <a href="/sistema/public/usuarios.php?accion=crear" class="btn btn-agregar">
            ➕ Agregar nuevo usuario
        </a>
    </div>

    <!-- Tabla de usuarios -->
    <table class="tabla-general">
        <thead>
            <tr>
                <th>ID</th>
                <th>Persona</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['persona_nombre'] . ' ' . $u['persona_apellido']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['rol_nombre']) ?></td>
                    <td>
                        <a href="/sistema/public/usuarios.php?accion=editar&id=<?= $u['id'] ?>" class="btn btn-editar">
                            ✏️ Editar
                        </a>
                        <a href="/sistema/src/controllers/usuarioController.php?accion=eliminar&id=<?= $u['id'] ?>"
                           onclick="return confirm('¿Estás segur@ de eliminar este usuario?')"
                           class="btn btn-eliminar">
                            🗑️ Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
