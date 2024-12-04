<?php

 require __DIR__ . '/../vendor/autoload.php';

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $name = htmlspecialchars($_POST['name']);
     $email = htmlspecialchars($_POST['email']);
     $subject = htmlspecialchars($_POST['subject']);
     $message = htmlspecialchars($_POST['message']);

    
     $mail = new PHPMailer(true);

     try {
         $mail->isSMTP();
         $mail->Host = 'localhost';
         $mail->Port = 1025;
         $mail->SMTPAuth = false;

        
         $mail->setFrom($email, $name);
         $mail->addAddress('fernandogomezromero2001@gmail.com', 'Contacto Kebab'); 

        
         $mail->isHTML(true);
         $mail->Subject = 'Nuevo mensaje de contacto: ' . $subject;
         $mail->Body = "
             <h3>Nuevo mensaje de contacto</h3>
             <p><strong>Nombre:</strong> $name</p>
             <p><strong>Correo electrónico:</strong> $email</p>
             <p><strong>Asunto:</strong> $subject</p>
             <p><strong>Mensaje:</strong><br>$message</p>
         ";
         $mail->AltBody = "Nuevo mensaje de contacto:\n
             Nombre: $name\n
             Correo electrónico: $email\n
             Asunto: $subject\n
             Mensaje:\n$message";

        
         $mail->send();
         echo json_encode(['status' => 'success', 'message' => 'Mensaje enviado correctamente.']);

        
     } catch (Exception $e) {
         echo json_encode(['status' => 'error', 'message' => 'Error al enviar el mensaje: ' . $mail->ErrorInfo]);
     }
 } else {
     echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
 }
