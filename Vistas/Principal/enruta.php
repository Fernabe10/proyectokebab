<?php
if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once './Vistas/Principal/landing-page.php';
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
    // Carga la landing page por defecto si no hay `menu` en la URL
    require_once './Vistas/Principal/landing-page.php';
}

    
    //Añadir otras rutas
