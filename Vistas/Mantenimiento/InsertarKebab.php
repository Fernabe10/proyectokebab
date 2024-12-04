<head>
    <link rel="stylesheet" href="css/estilo-insertarKebabAdmin.css">
    <script src="js/previsualizarImagen.js" defer></script>
    <script src="js/rellenarIngredientes.js" defer></script>
</head>
<body>
<h1 id="titulo">Insertar un Kebab de la casa</h1>

<form action="Api/ApiKebab.php" method="POST" enctype="multipart/form-data">
    <div id="contenedor1">
        <div>
            <label for="foto">Foto del kebab:</label>
            <input id="fileInput" type="file" name="foto" accept="image/*" required>
            <img id="preview" src="" alt="Previsualización de la imagen" style="display:none; max-width: 200px; margin-top: 10px;">
        </div>
        <div>
            <label for="nombre">Nombre:</label>
            <input name="nombre" type="text">
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" rows="5" cols="30" required></textarea>
        </div>
    </div>
    <div id="contenedor3">
        <h1>Ingredientes Disponibles</h1>
    </div>
    <input type="hidden" name="ingredientes_seleccionados" id="ingredientesSeleccionadosInput">
    
    
    <input type="submit" value="Añadir">
</form>
</body>