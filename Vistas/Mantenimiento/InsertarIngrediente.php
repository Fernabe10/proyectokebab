<head>
    <link rel="stylesheet" href="css/estilo-ingrediente.css">
    <script src="js/previsualizarImagen.js" defer></script>
    <script src="js/alergenos.js" defer></script>
</head>

<h1>Añadir un Ingrediente</h1>

<form action="Api/Api-Ingrediente.php" method="POST" enctype="multipart/form-data">
    <div>
        <label for="foto">Foto del ingrediente:</label>
        <input id="fileInput" type="file" name="foto" accept="image/*" required>
        <img id="preview" src="" alt="Previsualización de la imagen" style="display:none; max-width: 200px; margin-top: 10px;">
    </div>
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
    </div>
    <div>
        <label for="alergenos">Alergenos:</label>
        
        <select name="alergenos[]" id="alergenos" multiple>
        
        </select>
    </div>
    <div>
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" required>
    </div>
    <div>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" cols="30" rows="5"></textarea>
    </div>

    <input type="submit" value="Añadir">
</form>

