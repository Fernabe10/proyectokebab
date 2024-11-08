<head>
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/css/estilo-login.css">
</head>

<h1>Formulario de Inicio de Sesión</h1>

<form action="controladores/LoginUser.php" method="POST">
    <div>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" required>
    </div>
    <div>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>
    </div>
    
    <input type="submit" value="Iniciar Sesión">
</form>