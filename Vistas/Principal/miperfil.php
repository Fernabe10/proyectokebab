<head>
    <link rel="stylesheet" href="css/estilo-perfil.css">
    <script src="js/cargarPerfilUsuario.js"></script>
</head>

<h1>Tu Perfil</h1>
<div id="contenedor">
    <div class="perfil-contenedor">
        <div class="left-column">
            <label for="foto">Tu foto de perfil:</label>
            <img id="perfil-foto" src="" alt="Foto de perfil">
        </div>
        <div class="right-column">
            <div>
                <label for="nombre">Nombre:</label>
                <label for="name" name="nombre"></label>
            </div>
            <div>
                <label for="email">Correo: </label>
                <label for="correo" name="correo"></label>
            </div>
            <div>
                <label for="wallet">Monedero:</label>
                <label for="monedero" name="monedero"></label>
            </div>
            <div>
                <label for="address">Dirección:</label>
                <label for="direccion" name="direccion"></label>
            </div>
            <a href="?menu=modificarPerfil">Editar tu Perfil</a>
        </div>
    </div>
</div>