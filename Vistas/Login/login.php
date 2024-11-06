
<h1>Formulario de Inicio de Sesión</h1>

<form action="controladores/controladorUser.php" method="POST" enctype="multipart/form-data">
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