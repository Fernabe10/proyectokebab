<?php
Sesion::iniciarSesion();
var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monedero</title>
    <script src="js/monedero.js" defer></script>
</head>
<body>
    <h1>Tu Monedero</h1>
    <div>
        <h2>Saldo disponible:</h2>
        <span id="saldo"></span>
    </div>
    <div>
        <h2>Recargar Monedero</h2>
        <form action="Api/Api-Monedero.php" method="POST">
            <label>Introducir balance:</label>
            <input type="number" step="0.01" name="balance" required>
            <button type="submit">Añadir</button>
        </form>
    </div>
</body>
</html>