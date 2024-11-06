<head>
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/css/estilo-register.css">
</head>

<h1>Formulario de registro</h1>
<form action="controladores/controladorRegisterUser.php" method="POST" enctype="multipart/form-data">
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
    <div>
        <label for="foto">Foto:</label>
        <input type="file" name="foto">
    </div>

    <input type="submit" value="Enviar">
</form>
