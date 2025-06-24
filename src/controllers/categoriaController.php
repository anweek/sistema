<?php
require_once __DIR__ . '/../models/Categoria.php';

$categoriaModel = new Categoria();
$accion = $_GET['accion'] ?? '';

switch ($accion) {
    case 'guardar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $categoriaModel->crear($nombre);
            header('Location: ../../public/categorias.php');
            exit;
        }
        break;

    case 'eliminar':
        if (isset($_GET['id'])) {
            $categoriaModel->eliminar($_GET['id']);
            header('Location: ../../public/categorias.php');
            exit;
        }
        break;
}
?>
