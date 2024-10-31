<?php
Class Autocargador
{

  public static function autocargar()
  {
      spl_autoload_register('self::autocarga');
  }
  private static function autocarga($name)
  {
    require_once './repositorios/Conexion.php';
    require_once './clases/User.php';
    require_once './clases/Ingrediente.php';
    require_once './repositorios/RepoUser.php';
    require_once './repositorios/RepoIngrediente.php';
    
  }

  
}
Autocargador::autocargar();