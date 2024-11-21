<?php
require_once 'helpers/sesion.php';
Sesion::iniciarSesion();
?>
<head>
    <link rel="stylesheet" href="css/estilo-header.css">    
</head>
<header>
    <div>
        <img src="images/logo.png" alt="Kebab Express Logo">
        <span>Kebab Express</span>
    </div>
    <nav>
        <ul>
            <li><a href="?menu=inicio">Inicio</a></li>
            <div class="dropdown">
                <li>Kebabs</li>
                <div class="dropdown-content">
                        <a href="?menu=kebabdelacasa">De la casa</a><br>
                        <a href="?menu=kebabpersonalizado">Personalizado</a>
                        </div>
            </div>
            <li><a href="?menu=contacto">Contacto</a></li>

            <?php
            //admin
            if (Sesion::leer('rol') === 'admin') {
                echo '<li><a href="?menu=gestionUsuarios">Gestión de Usuarios</a></li>';
                echo '<div class="dropdown">
                <li>Gestionar Ingredientes</li>
                    <div class="dropdown-content">
                        <a href="?menu=insertarIngrediente">Insertar Ingrediente</a><br>
                        <a href="?menu=verIngredientes">Ver Ingredientes</a>
                        </div>
                    </div>';
                    echo '<div class="dropdown">
                    <li>Gestionar Kebabs</li>
                    <div class="dropdown-content">
                        <a href="?menu=insertarKebab">Insertar Kebab</a><br>
                        <a href="?menu=verKebabs">Ver Kebabs</a>
                        </div>
                    </div>';
                
            } elseif (Sesion::leer('rol') === 'cliente') {
                //cliente
                echo '<li><a href="?menu=misPedidos">Mis Pedidos</a></li>';
                echo '<li><a href="?menu=perfil">Mi Perfil</a></li>';
                echo '<li><a href="?menu=monedero">Monedero</a></li>';
            }
            ?>
        </ul>
    </nav>
    <div>
        <?php if (Sesion::leer('usuario')): ?>
            <span><?php echo Sesion::leer('usuario'); ?></span>
            <a href="helpers/logout.php">Cerrar Sesión</a>
        <?php else: ?>
            <a href="?menu=login">Iniciar Sesión</a>
            <a href="?menu=register">Registrarse</a>
        <?php endif; ?>
    </div>
</header>

                

