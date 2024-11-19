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

    // Obtener los datos del ingrediente desde el formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $foto = null;

    // Procesar la foto si se ha subido
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoContenido = file_get_contents($_FILES['foto']['tmp_name']);
        $foto = base64_encode($fotoContenido);
    }

    // Crear una instancia de Ingrediente
    $ingrediente = new Ingrediente(null, $nombre, $precio, $descripcion, $foto);
    $repoIngrediente = new RepoIngrediente();

    try {
        // Intentar insertar el ingrediente
        $resultado = $repoIngrediente->insertarIngrediente($ingrediente);

        if ($resultado) {
            echo "Ingrediente insertado correctamente.";
            
            // Obtener la última ID del ingrediente insertado
            $ingredienteId = $repoIngrediente->getLastId();

            // Verificar si existen alérgenos en el formulario
            if (!empty($_POST['alergenos']) && is_array($_POST['alergenos'])) {
                $repoAlergeno = new RepoAlergeno();
                $errorEnAlergenos = false;

                // Insertar cada alérgeno asociado al ingrediente
                foreach ($_POST['alergenos'] as $alergenoId) {
                    $exito = $repoAlergeno->insertarIngredienteAlergeno($ingredienteId, $alergenoId);
                    if (!$exito) {
                        $errorEnAlergenos = true;
                        break;
                    }
                }

                // Verificar si hubo algún error al insertar alérgenos
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
            'nombre' => $ingrediente->getNombre()
        ];
    }

    
    echo json_encode($resultado);
}


