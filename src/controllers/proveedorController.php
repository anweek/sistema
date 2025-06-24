<?php
require_once __DIR__ . '/../models/Proveedor.php';
require_once __DIR__ . '/../models/Persona.php';
require_once __DIR__ . '/../helpers/mail.php';

$proveedorModel = new Proveedor();
$personaModel = new Persona();

$accion = $_GET['accion'] ?? ''; // puede ser guardar, eliminar, actualizar

switch ($accion) {
    case 'guardar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreEmpresa = $_POST['nombre_empresa'] ?? '';
$contactoId = $_POST['contacto_id'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$email = $_POST['email'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$categoriaId = $_POST['categoria_id'] ?? ''; 

$proveedorModel->crear($nombreEmpresa, $contactoId, $telefono, $email, $direccion, $categoriaId);

            // Buscar datos del contacto para enviar correo
            $persona = $personaModel->obtenerPorId($contactoId);
            $contactoNombre = $persona['nombre'] . ' ' . $persona['apellido'];
            $contactoEmail = $persona['email'];

            enviarCorreoNuevoProveedor('anicetoreyes098@gmail.com', $nombreEmpresa, $contactoNombre, $contactoEmail);

           


            header('Location: ../../public/proveedores.php');
            exit;
        }
        break;

    case 'eliminar':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $proveedorModel->eliminar($id);
            header('Location: ../../public/proveedores.php');
            exit;
        }
        break;

    case 'actualizar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nombreEmpresa = $_POST['nombre_empresa'] ?? '';
            $contactoId = $_POST['contacto_id'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $email = $_POST['email'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $categoriaId = $_POST['categoria_id'] ?? '';

            if ($id) {
                $proveedorModel->actualizar($id, $nombreEmpresa, $contactoId, $telefono, $email, $direccion, $categoriaId);
                header('Location: ../../public/proveedores.php');
                exit;
            } else {
                echo "ID no válido";
            }
        }
        break;
}
