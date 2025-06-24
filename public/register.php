<?php
require_once '../public/header.php'; // Asegúrate de incluir el nuevo header con sidebar

require_once '../src/models/Usuario.php';
require_once '../src/models/Rol.php';
require_once '../src/models/Persona.php';

$personaModel = new Persona();
$personas = $personaModel->obtenerTodos();

$rolModel = new Rol();
$roles = $rolModel->obtenerTodos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $persona_id = $_POST['persona_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol_id = $_POST['rol_id'];

    $usuarioModel = new Usuario();
    $usuarioModel->crear($persona_id, $email, $password, $rol_id);

    header('Location: usuarios.php');
    exit;
}
?>

<h2>Registro de Usuario</h2>

<form method="POST">
    <label>Persona:</label><br>
    <select name="persona_id" required>
        <option value="">-- Selecciona una persona --</option>
        <?php foreach ($personas as $p): ?>
            <option value="<?= $p['id'] ?>">
                <?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Correo electrónico:</label><br>
    <input type="email" name="email" required>
    <br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required>
    <br><br>

    <label>Rol:</label><br>
    <select name="rol_id" required>
        <option value="">Selecciona un rol</option>
        <?php foreach ($roles as $rol): ?>
            <option value="<?= $rol['id'] ?>"><?= $rol['nombre'] ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <button type="submit">Registrarse</button>
</form>

</div> <!-- Cierre del .content -->
</body>
</html>
