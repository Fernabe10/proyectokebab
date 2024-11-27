<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    $to = "fernandogomezromero2001@gmail.com";
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();
    
    $body = "Nombre: $name\nCorreo: $email\nAsunto: $subject\n\nMensaje:\n$message";

    if (mail($to, "Formulario de contacto: $subject", $body, $headers)) {
        echo "Correo enviado correctamente.";
    } else {
        echo "Hubo un error al enviar el correo.";
    }
}
?>
