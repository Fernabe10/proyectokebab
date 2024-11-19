<?php
if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once './Vistas/Principal/landing-page.php';
    }
    if ($_GET['menu'] == "login") {
        require_once './Vistas/Login/login.php';
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
    if ($_GET['menu'] == "insertarIngrediente") {
        require_once './Vistas/mantenimiento/InsertarIngrediente.php';
    }
    if ($_GET['menu'] == "gestionUsuarios") {
        require_once './Vistas/mantenimiento/GestionUsuarios.php';
    }
    if ($_GET['menu'] == "insertarKebab") {
        require_once './Vistas/mantenimiento/InsertarKebab.php';
    }
    if ($_GET['menu'] == "kebabdelacasa") {
        require_once './Vistas/Principal/kebabdelacasa.php';
    }
    if ($_GET['menu'] == "kebabpersonalizado") {
        require_once './Vistas/Principal/kebabpersonalizado.php';
    }
    if ($_GET['menu'] == "monedero") {
        require_once './Vistas/Principal/monedero.php';
    }
} else {
    require_once './Vistas/Principal/landing-page.php';
}
?>
