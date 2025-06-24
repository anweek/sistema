<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/sistema/config/conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // 💡 Aquí usamos la clase correctamente
    $conexion = (new Conexion())->getConexion();

    $stmt = $conexion->prepare("INSERT INTO personas (nombre, apellido, telefono, email) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $apellido, $telefono, $email]);

    if ($stmt) {
        $mensaje = "✅ Persona registrada correctamente.";
    } else {
        $mensaje = "❌ Error al registrar la persona.";
    }
}
?>


<!-- HTML -->
<div class="persona-container">
    <h2>Crear Nueva Persona</h2>
<link rel="stylesheet" href="/sistema/src/templates/style.css">

    <?php if ($mensaje): ?>
        <div class="mensaje"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required>
<label for="email">Correo electrónico:</label>
<input type="email" name="email" required>

        <button type="submit">Guardar Persona</button>
    </form>
</div>
