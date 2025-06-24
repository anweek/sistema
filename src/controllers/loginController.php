<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->verificarLogin($email, $password);

    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header('Location: ../../public/index.php'); // Cambia esto por tu página principal
        exit;
    } else {
        $_SESSION['error'] = "Credenciales incorrectas";
        header('Location: ../../public/login.php');
        exit;
    }
}