<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer/Exception.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/SMTP.php';

function enviarCorreoNuevoProveedor($nombreEmpresa, $contacto, $emailContacto) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP (Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'anicetoreyes098@gmail.com';  // Tu correo
        $mail->Password = 'jeojnnsitiswqian';            // CLAVE DE APP (no tu contraseña normal)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente y destinatario (mismo correo, tú misma te notificarás)
        $mail->setFrom('anicetoreyes098@gmail.com', 'Sistema de Proveedores');
        $mail->addAddress('anicetoreyes098@gmail.com');  // Puedes poner otro si quieres

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo proveedor registrado 💼';
        $mail->Body = "
            <h3>📩 Se ha registrado un nuevo proveedor</h3>
            <p><strong>Empresa:</strong> {$contacto}</p>
            <p><strong>Contacto:</strong> {$emailContacto}</p>
            <p><strong>Email del contacto:</strong> {$nombreEmpresa}</p>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Puedes imprimir $e->getMessage() para depurar si quieres
        return false;
    }
}
