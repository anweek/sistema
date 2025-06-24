<?php
require_once '../src/models/Usuario.php';
require_once '../src/models/Rol.php';
require_once '../src/models/Persona.php';

$rolModel = new Rol();
$roles = $rolModel->obtenerTodos();

$personaModel = new Persona();
$personas = $personaModel->obtenerTodos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $persona_id = $_POST['persona_id'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol_id = $_POST['rol_id'] ?? '';

    $usuarioModel = new Usuario();
    $usuarioModel->crear($persona_id, $email, $password, $rol_id);

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <link rel="stylesheet" href="/sistema/src/templates/style.css">
</head>
<body>

<div class="register-container">
    <h2>Registro de Usuario</h2>

    <form method="POST">
        <div class="field-group">
    <label for="persona_id">Persona:</label>
    <select name="persona_id" required>
        <option value=""> Selecciona una persona </option>
        <?php foreach ($personas as $p): ?>
            <option value="<?= $p['id'] ?>">
                <?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <div class="form-helper">
        ¿No encuentras tu nombre en la lista? 
        <a href="/sistema/public/personas.php?accion=crear">Crea una nueva persona aquí</a>
    </div>
</div>



        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <label for="rol_id">Rol:</label>
        <select name="rol_id" required>
            <option value="">Selecciona un rol</option>
            <?php foreach ($roles as $rol): ?>
                <option value="<?= $rol['id'] ?>"><?= $rol['nombre'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Registrarse</button>
    </form>

    <div class="login-link">
        ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a>
    </div>
</div>

</body>
</html>
