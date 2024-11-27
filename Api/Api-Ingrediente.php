<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';


if ($_SERVER['REQUEST_METHOD']=='POST')
{
    InsertarIngrediente();
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
    traerIngredientes();
}
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
}

function InsertarIngrediente() {
    require_once '../cargadores/autocargador.php';

    
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $foto = null;

    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoContenido = file_get_contents($_FILES['foto']['tmp_name']);
        $foto = base64_encode($fotoContenido);
    }

    
    $ingrediente = new Ingrediente(null, $nombre, $precio, $descripcion, $foto);
    $repoIngrediente = new RepoIngrediente();

    try {
        
        $resultado = $repoIngrediente->insertarIngrediente($ingrediente);

        if ($resultado) {
            echo "Ingrediente insertado correctamente.";
            
            
            $ingredienteId = $repoIngrediente->getLastId();

            
            if (!empty($_POST['alergenos']) && is_array($_POST['alergenos'])) {
                $repoAlergeno = new RepoAlergeno();
                $errorEnAlergenos = false;

                
                foreach ($_POST['alergenos'] as $alergenoId) {
                    $exito = $repoAlergeno->insertarIngredienteAlergeno($ingredienteId, $alergenoId);
                    if (!$exito) {
                        $errorEnAlergenos = true;
                        break;
                    }
                }

                
                if ($errorEnAlergenos) {
                    echo "Error: No se pudieron insertar todos los alérgenos para el ingrediente.";
                } else {
                    echo "Todos los alérgenos se insertaron correctamente.";
                }
            } else {
                echo "No se especificaron alérgenos para este ingrediente.";
            }
        } else {
            echo "Error: No se pudo insertar el ingrediente en la base de datos.";
        }
    } catch (Exception $e) {
        echo "Error general: " . $e->getMessage();
    }
}

function traerIngredientes(){
    $repoIngrediente = new RepoIngrediente();
    $ingredientes = $repoIngrediente->getAllIngredientes();
    $resultado = [];
    foreach($ingredientes as $ingrediente){
        
        $resultado[] = [
            'id' => $ingrediente->getId(),
            'nombre' => $ingrediente->getNombre(),
            'precio' => $ingrediente->getPrecio(),
            'descripcion' => $ingrediente->getDescripcion(),
            'foto' => $ingrediente->getFoto()
        ];
    }
    
    echo json_encode($resultado);
}




