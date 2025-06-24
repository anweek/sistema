<?php
require_once __DIR__ . '/../../models/Persona.php';

$personaModel = new Persona();
$personas = $personaModel->obtenerTodos();
?>

<div class="content">
    <h2 class="titulo-lista">👥 Lista de Personas</h2>

    <div class="acciones-superiores">
        <a href="/sistema/public/personas.php?accion=crear" class="btn btn-agregar">
            ➕ Agregar nueva persona
        </a>

        <a href="/sistema/public/reportes/reportesPersonas.php" class="btn btn-pdf">
            🧾 Generar PDF
        </a>
    </div>

    <table class="tabla-general">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personas as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td><?= htmlspecialchars($p['apellido']) ?></td>
                    <td><?= htmlspecialchars($p['telefono']) ?></td>
                    <td><?= htmlspecialchars($p['email']) ?></td>
                    <td>
                        <a href="/sistema/public/personas.php?accion=editar&id=<?= $p['id'] ?>" class="btn btn-editar">
                            ✏️ Editar
                        </a>
                        <a href="/sistema/src/controllers/personaController.php?accion=eliminar&id=<?= $p['id'] ?>" 
                           onclick="return confirm('¿Estás segur@ de eliminar esta persona?')" 
                           class="btn btn-eliminar">
                            🗑️ Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>