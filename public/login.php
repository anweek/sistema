<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../src/models/Usuario.php';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->verificarLogin($email, $password);

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre']; // para mostrar "Bienvenido"
        header('Location: /sistema/public/personas.php'); // o donde quieras dirigirlo
        exit;
    } else {
        $error = "Correo o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/sistema/src/templates/style.css">
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($error)): ?>
        <div class="error-msg"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" required>

        <button type="submit">Entrar</button>
    </form>

    <div class="register-link">
        ¿No tienes una cuenta? <a href="/sistema/public/usuarios.php?accion=crear">Regístrate aquí</a>
    </div>
</div>

</body>
</html>

