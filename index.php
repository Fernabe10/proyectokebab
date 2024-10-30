<?php
class Principal
{
    public static function main()
    {
        require_once './cargadores/autocargador.php';
    }
}


Principal::main();


$rc = new RepoUsuario(Conexion::getConection());//meto en rc 
$miusuario = $rc->findbyId(1);
var_dump($miusuario);

?>