<head>
    <script src="js/personalizarKebab.js" defer></script>
    <link rel="stylesheet" href="css/estilo-insertarKebab.css">
</head>

<body>
    <main>
        <h1>Personalización del kebab</h1>
        <form id="formKebabPersonalizado">
            <div id="contenedor1">
                

                <div>
                    <img id="fotokebab">
                </div>
                <div>
                    <label for="nombre">Nombre:</label>
                    <label id="nombre"></label>
                </div>
                <div>
                    <label for="descripcion">Descripción:</label>
                    <label id="descripcion"></label>
                </div>
                <div>
                    <label for="descripcion">Precio:</label>
                    <label id="precio"></label>
                </div>
            </div>

            <div id="contenedor3">
                <h1>Ingredientes Disponibles</h1>
            </div>

            <input type="hidden" name="ingredientes_seleccionados" id="ingredientesSeleccionadosInput">
            <button type="submit">Pedir</button>
        </form>
    </main>
</body>
