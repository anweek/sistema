<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/persona.php';

$personaModel = new Persona();

// Guardar nueva persona
if (isset($_POST['crear'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $personaModel->crear($nombre, $apellido, $telefono, $email);
    header('Location: ../../public/personas.php');
    exit;
}

// Cargar vista de edición
if (isset($_GET['accion']) && $_GET['accion'] === 'editar') {
    $id = $_GET['id'];
    $persona = $personaModel->obtenerPorId($id);
    include __DIR__ . '/../templates/personas/editar.php';

// Actualizar persona
} elseif (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $personaModel->actualizar($id, $nombre, $apellido, $telefono, $email);
    header('Location: ../../public/personas.php');
    exit;

// Eliminar persona
} elseif (isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
    $personaModel->eliminar($_GET['id']);
    header('Location: ../../public/personas.php');
}
