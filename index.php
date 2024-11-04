<?php
class Principal
{
    public static function main()
    {
        require_once './cargadores/autocargador.php';
        require_once './helpers/sesion.php';
        require_once './Vistas/Principal/layout.php';
    }
}


Principal::main();



?>