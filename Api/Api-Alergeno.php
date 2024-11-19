<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    
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


function traerAlergenos(){
    $repoAlergeno = new RepoAlergeno();
    $alergenos = $repoAlergeno->getAllAlergenos();

    $resultado = [];
    foreach($alergenos as $alergeno){
        $resultado[] = [
            'id' => $alergeno->getId(),
            'nombre' => $alergeno->getNombre(),
            'descripcion' => $alergeno->getDescripcion()
        ];
    }

    echo json_encode($resultado);
}