<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="css/estilo-carrito.css">
    <script src="js/rellenarCarrito.js"></script>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio Total (€)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="carritoContainer">
        </tbody>
    </table>
    <div class="actions">
    <button id="Pedir">Pedir</button>
    <button id="vaciarCarrito" type="button">Vaciar Carrito</button>
    </div>

</body>
</html>