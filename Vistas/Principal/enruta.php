<?php
if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once './Vistas/Principal/landing-page.php';
    }
    if ($_GET['menu'] == "login") {
        require_once './Vistas/Principal/landing-page.php';
    }
    if ($_GET['menu'] == "register") {
        require_once './Vistas/Login/register.php';
    }
    if ($_GET['menu'] == "kebabs") {
        require_once './Vistas/Mantenimiento/kebabs.php';
    }
    if ($_GET['menu'] == "alergenos") {
        require_once './Vistas/Login/cerrarsesion.php';
    }
    if ($_GET['menu'] == "contacto") {
        require_once './Vistas/mantenimiento/mantenimiento.php';
     
    }

} else {
    
    require_once './Vistas/Principal/landing-page.php';
}

    
    //Añadir otras rutas
