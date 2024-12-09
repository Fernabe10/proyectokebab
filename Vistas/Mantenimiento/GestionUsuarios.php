<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <script src="js/rellenarTablaUsuarios.js" defer></script>
    <link rel="stylesheet" href="css/estilo-tablaUsuarios.css">
</head>

<body>
    <h1>Gestión de Usuarios</h1>

    <table id="tabla" border="1" class="nombres">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Monedero</th>
                <th>Rol</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody id="nombres">

        </tbody>
    </table>


    <form id="formulario" action="Api/ApiUser.php" method="PUT">
        <div id="caja1">
            <div>
                <label for="id">ID del usuario:</label>
                <input name="id" id="name" type="number" disabled>
            </div>
            <div>
                <label for="foto">Foto:</label>
                <img id="perfil-foto" alt="foto_usuario">
                <input src="" type="file" name="foto">
            </div>
        </div>
        <div id="caja2">
            <div>
                <label for="nombre">Nombre:</label>
                <input name="nombre" type="text">
            </div>
            <div>
                <label for="contrasena">Contraseña</label>
                <input name="contrasena" type="password">
            </div>
            <div>
                <label for="correo">Correo</label>
                <input name="email" type="email">
            </div>
            <div>
                <label for="direccion">Direccion:</label>
                <input name="direccion" type="text">
            </div>
            <div>
                <label for="monedero">Monedero:</label>
                <input type="number" step="0.01" name="monedero">
            </div>
            <div>
                <label for="rol">Rol:</label>
                <select name="roles" id="roles">
                    <option value="cliente">Cliente</option>
                    <option value="admin">Admin</option>   
                </select>
            </div>
        </div>
        
        <input type="submit" class="botones" value="Guardar">
        <input id="cancelar" class="botones" value="Cancelar">
        
    </form>
</body>

</html>