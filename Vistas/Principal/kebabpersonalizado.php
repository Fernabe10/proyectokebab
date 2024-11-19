<head>
    <link rel="stylesheet" href="css/estilo-insertarKebab.css">
    <script src="js/rellenarIngredientes.js" defer></script>
</head>


<main>
<h1>Tu Kebab Personalizado:</h1>
    <form action="" method="">
        <div id="contenedor1">
            <div>
                <label for="nombre">Nombre:</label>
                <input name="nombre" type="text">
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


        <input type="submit" value="Pedir">
    </form>
</main>