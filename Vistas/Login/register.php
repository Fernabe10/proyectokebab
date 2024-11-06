<h1>Insertar un usuario</h1>
<form action="controladores/controladorUser.php" method="POST" enctype="multipart/form-data">
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>
    </div>
    <div>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>
    </div>
    <div>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion">
    </div>
    <div>
        <label for="foto">Tu foto:</label>
        <input type="file" name="foto">
    </div>

    <input type="submit" value="Enviar">
</form>
