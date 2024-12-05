<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = ($_POST['name'] ?? '');
    $email = ($_POST['email'] ?? '');
    $subject = ($_POST['subject'] ?? 'Sin asunto');
    $message = ($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
        exit;
    }

    
    $mail = new PHPMailer();

    try {
        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->Port = 1025; 
        $mail->SMTPAuth = false;

        $mail->setFrom($email, $name);
        $mail->addAddress('fernandogomezromero2001@gmail.com', 'Contacto Kebab');

        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de contacto: $subject";
        $mail->Body = "
            <h3>Nuevo mensaje de contacto</h3>
            <p><strong>Nombre:</strong> $name</p>
            <p><strong>Correo:</strong> $email</p>
            <p><strong>Mensaje:</strong><br>$message</p>
        ";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Mensaje enviado correctamente.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al enviar el mensaje: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
