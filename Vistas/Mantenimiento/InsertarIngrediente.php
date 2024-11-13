<head>
    <link rel="stylesheet" href="css/estilo-ingrediente.css">
</head>

<h1>Añadir un Ingrediente</h1>

<form action="controladores/Ingrediente.php" method="POST" enctype="multipart/form-data">
    <div>
        <label for="foto">Foto del ingrediente:</label>
        <input type="file" name="foto" accept="image/*" required>
    </div>
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
    </div>
    <div>
        <label for="alergenos">Alergenos:</label>
        <input type="text" name="alergenos" required>
    </div>
    <div>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" required>
    </div>
    <div>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" cols="30" rows="5"></textarea>
    </div>

    <input type="submit" value="Añadir">
</form>
