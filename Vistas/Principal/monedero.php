<?php
Sesion::iniciarSesion();
$saldo = Sesion::leer('monedero');
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monedero</title>
    <link rel="stylesheet" href="css/estilo-monedero.css">
</head>
<body>
    <h1>Tu Monedero</h1>
    <div id="container">
        
        <div>
            <h2>Saldo disponible:</h2>
            <span id="saldo"><?= number_format($saldo, 2) ?> €</span>
        </div>

        
        <div>
            <h2>Recargar Monedero</h2>
            <form action="Api/Api-Monedero.php" method="POST">
                <label for="balance">Introducir balance:</label>
                <input id="balance" type="number" step="0.01" name="balance" required>
                <button type="submit">Añadir</button>
            </form>
        </div>
    </div>
</body>
</html>

