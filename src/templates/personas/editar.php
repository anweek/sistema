<?php 
require_once '../src/models/Persona.php';
$persona = new Persona();
$datos = $persona->obtenerPorId($_GET['id']);
 ?>

 <h2>Editar Persona</h2>
<form method="POST" action="../src/controllers/PersonaController.php">
    <input type="hidden" name="id" value="<?= $datos['id'] ?>">
    <input type="text" name="nombre" value="<?= $datos['nombre'] ?>" required>
    <input type="text" name="apellido" value="<?= $datos['apellido'] ?>" required>
    <input type="text" name="telefono" value="<?= $datos['telefono'] ?>" required>
    <input type="email" name="email" value="<?= $datos['email'] ?>" required>
    <button type="submit" name="actualizar">Actualizar</button>
</form>