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

    // Cargar automáticamente Composer si existe
    $composerAutoload = $raiz . 'vendor/autoload.php';
    if (file_exists($composerAutoload)) {
        require_once $composerAutoload;
    }

    // Repositorios y clases del proyecto
    require_once $raiz . 'repositorios/Conexion.php';
    require_once $raiz . 'clases/User.php';
    require_once $raiz . 'clases/Ingrediente.php';
    require_once $raiz . 'clases/Kebab.php';
    require_once $raiz . 'clases/Alergeno.php';
    require_once $raiz . 'clases/Pedido.php';
    require_once $raiz . 'repositorios/RepoPedido.php';
    require_once $raiz . 'repositorios/RepoUser.php';
    require_once $raiz . 'repositorios/RepoIngrediente.php';
    require_once $raiz . 'repositorios/RepoKebab.php';
    require_once $raiz . 'repositorios/RepoAlergeno.php';
    require_once $raiz . 'repositorios/RepoKebabIngrediente.php';
    require_once $raiz . 'repositorios/RepoIngredienteAlergeno.php';
}

}


Autocargador::autocargar();
