<head>
    <link rel="stylesheet" href="css/estilo-modificarPerfil.css">
    <script src="js/previsualizarImagen.js"></script>
</head>

<h1>Modificar Perfil</h1>

<form action="Api/ApiUser.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    <div class="left-section">
        <label for="foto">Actualizar Foto:</label>
        <input type="file" id="fileInput" name="foto" accept="image/*">
        <img id="preview" src="" alt="Previsualización de la imagen" style="display:none; max-width: 200px; margin-top: 10px;">
    </div>
    <div class="right-section">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" required>
        </div>
        <div>
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" required>
        </div>
    </div>
    <input type="submit" value="Guardar Cambios">
</form>



