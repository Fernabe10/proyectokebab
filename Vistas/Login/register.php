<head>
    <script src="js/validarRegistro.js"></script>
    <link rel="stylesheet" href="css/estilo-register.css">
</head>

<h1>Formulario de registro</h1>
<form action="Api/ApiUser.php" method="POST" enctype="multipart/form-data">
    <div>
        <label for="foto">Foto:</label>
        <input type="file" name="foto" accept="image/*" >
        <label for="error" class="claseErrores"></label>
    </div>
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre">
        <label for="error" class="claseErrores"></label>
    </div>
    <div>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" >
        <label for="error" class="claseErrores"></label>
    </div>
    <div>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" >
        <label for="error" class="claseErrores"></label>
    </div>
    <div>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion">
        <label for="error" class="claseErrores"></label>
    </div>
    

    <input type="submit" value="Registrarse">

    <a href="?menu=login">¿Ya estas registrado?</a>
</form>
