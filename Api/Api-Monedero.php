<?php
require_once '../helpers/sesion.php';
require_once '../cargadores/autocargador.php';

Sesion::iniciarSesion();


$usuarioId = Sesion::leer('usuario_id');

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    agregarFondos($usuarioId);
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
    traerMonedero();
}
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
}

function traerMonedero($usuarioId) {
    $repoUsuario = new RepoUsuario();
    $monedero = $repoUsuario->traerMonedero($usuarioId);

    if ($monedero !== null) {
        header('Content-Type: text/plain');
        echo number_format($monedero, 2, '.', ''); 
    }
}

function agregarFondos($usuarioId) {
    $balance = $_POST['balance'];
    //compruebo que es un numero
    if ($balance === null || !is_numeric($balance) || $balance <= 0) {
        echo "Monto inválido.";
        exit;
    }

    $repoUsuario = new RepoUsuario();
    $resultado = $repoUsuario->recargarMonedero($usuarioId, $balance);

    if ($resultado) {
        $nuevoSaldo = $repoUsuario->traerMonedero($usuarioId);
        Sesion::escribir('monedero', $nuevoSaldo);
    } else {
        echo "Error al recargar el monedero.";
    }
}


