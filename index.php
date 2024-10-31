<?php
class Principal
{
    public static function main()
    {
        require_once './cargadores/autocargador.php';
    }
}


Principal::main();


$kebab = new Kebab(
    null, "Kebab Mixto", "mixto.jpg", 5.99                  
);

$repoKebab = new RepoKebab();

try {
    $repoKebab->insertarKebab($kebab);
    echo "Kebab insertado correctamente";
} catch (Exception $e) {
    echo "Error al insertar el kebab: " . $e->getMessage();
}

?>