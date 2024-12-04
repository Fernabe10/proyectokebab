<head>
    <script src="js/validarLogin.js"></script>
    <link rel="stylesheet" href="css/estilo-login.css">
</head>

<h1>Formulario de Inicio de Sesión</h1>

<form action="Api/ApiSesion.php" method="POST">
    <div>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="email" required>
        <label for="error" class="claseErrores"></label>
    </div>
    <div>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="password" required>
        <label for="error" class="claseErrores"></label>
    </div>
    
    <input type="submit" value="Iniciar Sesión">
    <div>
        <a href="?menu=register">¿No estas registrado?</a>
    </div>
</form>
