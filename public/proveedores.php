<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Incluye el encabezado (ubicado en /public)
include 'header.php';

require_once __DIR__ . '/../src/models/Proveedor.php';
require_once __DIR__ . '/../src/models/Persona.php';

$proveedorModel = new Proveedor();
$personaModel = new Persona();
$personas = $personaModel->obtenerTodos(); // 💥 Aquí obtenemos las personas

if (isset($_GET['persona_id']) && $_GET['persona_id'] !== '') {
    $persona_id = $_GET['persona_id'];
    $proveedores = $proveedorModel->obtenerPorPersona($persona_id);
} elseif (isset($_GET['buscar']) && $_GET['buscar'] !== '') {
    $nombre = $_GET['buscar'];
    $proveedores = $proveedorModel->buscarPorNombre($nombre);
} else {
    $proveedores = $proveedorModel->obtenerTodos();
}

$accion = $_GET['accion'] ?? null;

$archivo = match ($accion) {
    'crear'  => __DIR__ . '/../src/templates/proveedores/crear.php',
    'editar' => __DIR__ . '/../src/templates/proveedores/editar.php',
    default  => __DIR__ . '/../src/templates/proveedores/listar.php',
};

if (file_exists($archivo)) {
    include $archivo;
} else {
    echo "Archivo no encontrado: $archivo";
}
?>