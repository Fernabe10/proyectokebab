<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';


if ($_SERVER['REQUEST_METHOD']=='POST')
{
    insertarKebab();
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
    traerKebabs(); 
}
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
}



function insertarKebab() {
    
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $foto = null;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoContenido = file_get_contents($_FILES['foto']['tmp_name']);
        $foto = base64_encode($fotoContenido);
    }

    
    $kebab = new Kebab(null, $nombre, $foto, $descripcion, $precio);

    
    $repoKebab = new RepoKebab();
    $kebab = $repoKebab->insertarKebab($kebab);

    
    $ingredientesSeleccionados = json_decode($_POST['ingredientes_seleccionados']);

    
    if ($ingredientesSeleccionados) {
        $repoKebabIngrediente = new RepoKebabIngrediente();

        foreach ($ingredientesSeleccionados as $ingredienteNombre) {
            
            $repoIngrediente = new RepoIngrediente();
            $ingrediente = $repoIngrediente->obtenerIngredientePorNombre($ingredienteNombre);

            if ($ingrediente) {
                
                $cantidad = 1; 
                $repoKebabIngrediente->insertarKebabIngrediente($kebab->getId(), $ingrediente->getId(), $cantidad);
            }
        }
    }

    
}

function traerKebabs(){
    $repoKebab = new RepoKebab();
    $kebabs = $repoKebab->getAllKebabs();

    $resultado = [];
    foreach ($kebabs as $kebab) {
        
        $repoKebabIngrediente = new RepoKebabIngrediente();
        $ingredientes = $repoKebabIngrediente->getIngredientesByKebabId($kebab['id']);

        $ingredientesList = [];
        foreach ($ingredientes as $ingrediente) {
            $ingredientesList[] = $ingrediente['nombre'];
        }

        $resultado[] = [
            'id' => $kebab['id'],
            'nombre' => $kebab['nombre'],
            'foto' => $kebab['foto'],
            'descripcion' => $kebab['descripcion'],
            'precio' => $kebab['precio_base'],
            'ingredientes' => $ingredientesList
        ];
    }

    echo json_encode($resultado);
}







