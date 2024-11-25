<head>
    <link rel="stylesheet" href="css/estilo-insertarKebab.css">
    <script src="js/rellenarIngredientes.js" defer></script>
    <script src="js/carritoPersonalizado.js" defer></script>
</head>


<main>
    <h1>Tu Kebab Personalizado:</h1>
    <form id="formKebabPersonalizado">
    <div id="contenedor1">
        <div>
            <label for="nombre">Nombre:</label>
            <input name="nombre" type="text" id="nombre" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="5" cols="30" required></textarea>
        </div>
    </div>
    <div id="contenedor3">
        <h1>Ingredientes Disponibles</h1>
    </div>
    <input type="hidden" name="ingredientes_seleccionados" id="ingredientesSeleccionadosInput">
    <button type="submit">Pedir</button>
</form>
</main>
