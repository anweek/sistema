<?php
require_once __DIR__ . '/../../models/Proveedor.php';
require_once __DIR__ . '/../../models/Persona.php';
require_once __DIR__ . '/../../models/Categoria.php';

$proveedorModel = new Proveedor();
$personaModel = new Persona();
$categoriaModel = new Categoria();

$personas = $personaModel->obtenerTodos();
$categorias = $categoriaModel->obtenerTodas();
$proveedores = [];

if (!empty($_GET['buscar'])) {
    $busqueda = $_GET['buscar'];
    $proveedores = $proveedorModel->buscarPorNombre($busqueda);
} elseif (!empty($_GET['persona_id'])) {
    $persona_id = $_GET['persona_id'];
    $proveedores = $proveedorModel->obtenerPorPersona($persona_id);
} else {
    $proveedores = $proveedorModel->obtenerTodos();
}
?>

<div class="content">
    <h2 class="titulo-lista">🏢 Lista de Proveedores</h2>

    <!-- BUSCADOR -->
    <form method="GET" action="" class="form-busqueda">
        <input type="text" name="buscar" id="input-buscar" placeholder="Buscar proveedor por nombre"
               value="<?= htmlspecialchars($_GET['buscar'] ?? '') ?>">
        <button type="submit" class="btn btn-buscar">🔍 Buscar</button>
    </form>

    <!-- LIMPIAR INPUT -->
    <script>
        if (window.location.search.includes('buscar=')) {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname);
            }
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('input-buscar').value = '';
            });
        }
    </script>

    <!-- FILTRO POR PERSONA -->
    <form method="GET" action="" class="form-filtro">
        <select name="persona_id" onchange="this.form.submit()">
            <option value="">-- Filtrar por persona --</option>
            <?php foreach ($personas as $p): ?>
                <option value="<?= $p['id'] ?>" <?= (isset($_GET['persona_id']) && $_GET['persona_id'] == $p['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- ACCIONES SUPERIORES -->
    <div class="acciones-superiores">
        <a href="/sistema/public/proveedores.php?accion=crear" class="btn btn-agregar">
            ➕ Agregar nuevo proveedor
        </a>

        <a href="/sistema/public/estadisticasProveedores.php" class="btn btn-pdf">
            📊 Ver Estadísticas
        </a>
    </div>

    <!-- TABLA -->
    <table class="tabla-general">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Contacto</th>
                <th>Categoría</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($proveedores)): ?>
                <?php foreach ($proveedores as $prov): ?>
                    <tr>
                        <td><?= $prov['id'] ?></td>
                        <td><?= htmlspecialchars($prov['nombre_empresa']) ?></td>
                        <td><?= htmlspecialchars(($prov['contacto_nombre'] ?? '') . ' ' . ($prov['contacto_apellido'] ?? '')) ?></td>
                        <td><?= htmlspecialchars($prov['categoria_nombre'] ?? 'Sin categoría') ?></td>
                        <td><?= htmlspecialchars($prov['telefono']) ?></td>
                        <td><?= htmlspecialchars($prov['email']) ?></td>
                        <td><?= htmlspecialchars($prov['direccion']) ?></td>
                        <td>
                            <a href="/sistema/public/proveedores.php?accion=editar&id=<?= $prov['id'] ?>" class="btn btn-editar">
                                ✏️ Editar
                            </a>
                            <a href="/sistema/src/controllers/proveedorController.php?accion=eliminar&id=<?= $prov['id'] ?>" 
                               onclick="return confirm('¿Estás segur@ de eliminar este proveedor?')" 
                               class="btn btn-eliminar">
                                🗑️ Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center;">No se encontraron proveedores</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

