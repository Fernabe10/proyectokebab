<head>
    <link rel="stylesheet" href="css/estilo-insertarAlergeno.css">
    <script src="js/previsualizarImagen.js" defer></script>
</head>

<h1>Añadir un Alergeno</h1>

<form action="Api/Api-Alergeno.php" method="POST" enctype="multipart/form-data">
    <div>
        <label for="foto">Foto del alérgeno:</label>
        <input id="fileInput" type="file" name="foto" accept="image/*" required>
        <img id="preview" src="" alt="Previsualización de la imagen" style="display:none; max-width: 200px; margin-top: 10px;">
    </div>
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
    </div>

    <input type="submit" value="Añadir">
</form>