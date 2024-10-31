<?php
class Principal
{
    public static function main()
    {
        require_once './cargadores/autocargador.php';
    }
}


Principal::main();

// Crear el repositorio
$repo = new RepoIngrediente();

// Eliminar el ingrediente con ID 1
if ($repo->eliminarIngrediente(1)) {
    echo "Ingrediente eliminado correctamente";
} else {
    echo "No se encontró el ingrediente con el ID especificado";
}

?>