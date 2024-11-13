<head>
    <link rel="stylesheet" href="css/estilo-register.css">
</head>

<h1>Formulario de registro</h1>
<form action="Api/ApiUser.php" method="POST" enctype="multipart/form-data">
    <div>
        <label for="foto">Foto:</label>
        <input type="file" name="foto" accept="image/*" required>
    </div>
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>
    </div>
    <div>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>
    </div>
    <div>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" required>
    </div>
    <div>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion">
    </div>

    <input type="submit" value="Enviar">
</form>
