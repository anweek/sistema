<?php
require_once __DIR__ . '/../../models/Usuario.php';
require_once __DIR__ . '/../../models/Persona.php';
require_once __DIR__ . '/../../models/Rol.php';

$usuarioModel = new Usuario();
$personaModel = new Persona();
$rolModel = new Rol();

// Obtener datos del usuario a editar
$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID de usuario no proporcionado.";
    exit;
}

$usuario = $usuarioModel->obtenerPorId($id);
$personas = $personaModel->obtenerTodos();
$roles = $rolModel->obtenerTodos();

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit;
}
?>

<h2>Editar Usuario</h2>

<form method="POST" action="/sistema/src/controllers/usuarioController.php">
    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

    <label>Persona:</label>
    <select name="persona_id" required>
        <option value="">-- Selecciona una persona --</option>
        <?php foreach ($personas as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $p['id'] == $usuario['persona_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
    <br><br>

    <label>Rol:</label>
    <select name="rol_id" required>
        <option value="">-- Selecciona un rol --</option>
        <?php foreach ($roles as $rol): ?>
            <option value="<?= $rol['id'] ?>" <?= $rol['id'] == $usuario['rol_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($rol['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <button type="submit" name="actualizar">Actualizar</button>
</form>
