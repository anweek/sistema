<?php
require_once __DIR__ . '/../../models/Persona.php';
require_once __DIR__ . '/../../models/Categoria.php';

$personaModel = new Persona();
$personas = $personaModel->obtenerTodos();

$categoriaModel = new Categoria();
$categorias = $categoriaModel->obtenerTodas();
?>

<h2>Nuevo Proveedor</h2>

<form method="POST" action="/sistema/src/controllers/proveedorController.php?accion=guardar">
    <table>
        <tr>
            <td><input type="text" name="nombre_empresa" placeholder="Nombre Empresa" required></td>

            <td>
                <select name="contacto_id" required>
                    <option value="">Seleccione un contacto</option>
                    <?php foreach ($personas as $p): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>

            <td><input type="text" name="telefono" placeholder="Teléfono" required></td>
            <td><input type="email" name="email" placeholder="Email" required></td>
            <td><input type="text" name="direccion" placeholder="Dirección" required></td>

            <td>
                <select name="categoria_id" required>
                    <option value="">-- Selecciona una categoría --</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat['id'] ?>">
                            <?= htmlspecialchars($cat['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>

            <td><button type="submit">Guardar</button></td>
        </tr>
    </table>
</form>

