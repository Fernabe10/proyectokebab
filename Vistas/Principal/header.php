<?php
require_once 'helpers/sesion.php';
Sesion::iniciarSesion();
?>

<header>
    <div>
        <img src="images/logo.png" alt="Kebab Express Logo">
        <span>Kebab Express</span>
    </div>
    <nav>
        <ul>
            <li><a href="?menu=inicio">Inicio</a></li>
            <li><a href="?menu=kebabs">Kebabs</a></li>
            <li><a href="?menu=alergenos">Alérgenos</a></li>
            <li><a href="?menu=contacto">Contacto</a></li>

            <?php
            // Mostrar opciones adicionales si el usuario es admin
            if (Sesion::leer('rol') === 'admin') {
                echo '<li><a href="?menu=gestionUsuarios">Gestión de Usuarios</a></li>';
                echo '<li><a href="?menu=insertarIngrediente">Insertar un Ingrediente</a></li>';
            } elseif (Sesion::leer('rol') === 'cliente') {
                // Opciones exclusivas para clientes
                echo '<li><a href="?menu=misPedidos">Mis Pedidos</a></li>';
                echo '<li><a href="?menu=perfil">Mi Perfil</a></li>';
            }
            ?>
        </ul>
    </nav>
    <div>
        <?php if (Sesion::leer('usuario')): ?>
            <span>Bienvenido, <?php echo Sesion::leer('usuario'); ?></span>
            <a href="helpers/logout.php">Cerrar Sesión</a>
        <?php else: ?>
            <a href="?menu=login">Iniciar Sesión</a>
            <a href="?menu=register">Registrarse</a>
        <?php endif; ?>
    </div>
</header>




