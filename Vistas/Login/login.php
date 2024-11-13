<head>
    <link rel="stylesheet" href="css/estilo-login.css">
</head>

<h1>Formulario de Inicio de Sesión</h1>

<form action="Api/ApiSesion.php" method="POST">
    <div>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="password" required>
    </div>
    
    <input type="submit" value="Iniciar Sesión">
</form>