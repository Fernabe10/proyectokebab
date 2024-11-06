<?php
class Autocargador
{
    public static function autocargar()
    {
        spl_autoload_register('self::autocarga');
    }

    private static function autocarga($name)
    {
        
        $raiz = __DIR__ . '/../';

        
        require_once $raiz . 'repositorios/Conexion.php';
        require_once $raiz . 'clases/User.php';
        require_once $raiz . 'clases/Ingrediente.php';
        require_once $raiz . 'clases/Kebab.php';
        require_once $raiz . 'repositorios/RepoUser.php';
        require_once $raiz . 'repositorios/RepoIngrediente.php';
        require_once $raiz . 'repositorios/RepoKebab.php';
        require_once $raiz . 'controladores/controladorRegisterUser.php';
    }
}


Autocargador::autocargar();
