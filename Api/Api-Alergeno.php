<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    insertarAlergeno();
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
    traerAlergenos();
}
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
}

function insertarAlergeno(){
    $nombre = $_POST['nombre'];
    $foto = null;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoContenido = file_get_contents($_FILES['foto']['tmp_name']);
        $foto = base64_encode($fotoContenido);
    }

    $alergeno = new Alergeno(null, $nombre, $foto);
    $repoAlergeno = new RepoAlergeno();

    $resultado = $repoAlergeno->insertarAlergeno($alergeno);

    if ($resultado) {
        echo "Alergeno insertado correctamente.";
    }
}

function traerAlergenos(){
    $repoAlergeno = new RepoAlergeno();
    $alergenos = $repoAlergeno->getAllAlergenos();

    $resultado = [];
    foreach($alergenos as $alergeno){
        $resultado[] = [
            'id' => $alergeno->getId(),
            'nombre' => $alergeno->getNombre(),
            'foto' => $alergeno->getFoto(),
        ];
    }

    echo json_encode($resultado);
}