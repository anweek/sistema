<?php 
require_once __DIR__ . '/../../models/Proveedor.php';
require_once __DIR__ . '/../../models/Persona.php';
require_once __DIR__ . '/../../models/Categoria.php';

$proveedorModel = new Proveedor();
$personaModel = new Persona();
$categoriaModel = new Categoria();

$datos = $proveedorModel->obtenerPorId($_GET['id']);
$personas = $personaModel->obtenerTodos();
$categorias = $categoriaModel->obtenerTodas();
?>

<h2>Editar Proveedor</h2>

<form method="POST" action="/sistema/src/controllers/proveedorController.php?accion=actualizar">
    <input type="hidden" name="id" value="<?= $datos['id'] ?>">

    <input type="text" name="nombre_empresa" value="<?= htmlspecialchars($datos['nombre_empresa']) ?>" placeholder="Nombre de Empresa" required>

    <select name="contacto_id" required>
        <option value="">Seleccione un contacto</option>
        <?php foreach ($personas as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $p['id'] == $datos['contacto_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="text" name="telefono" value="<?= htmlspecialchars($datos['telefono']) ?>" placeholder="Teléfono" required>
    <input type="email" name="email" value="<?= htmlspecialchars($datos['email']) ?>" placeholder="Email" required>
    <input type="text" name="direccion" value="<?= htmlspecialchars($datos['direccion']) ?>" placeholder="Dirección" required>

    <!-- Selección de categoría -->
    <select name="categoria_id" required>
        <option value="">-- Selecciona una categoría --</option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $datos['categoria_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Actualizar</button>
</form>


