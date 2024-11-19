<?php
require_once '../helpers/sesion.php';
require_once '../cargadores/autocargador.php';

// Iniciar la sesión antes de cualquier operación
Sesion::iniciarSesion();

if (!Sesion::existe('usuario_id')) {
    http_response_code(401); // Código de error para no autorizado
    echo "Usuario no autenticado";
    exit;
}

// Obtener el usuario ID de la sesión
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
        header('Content-Type: text/plain'); // Indicamos que el contenido es texto plano
        echo number_format($monedero, 2, '.', ''); // Asegúrate de devolver un número formateado
    } else {
        http_response_code(500); // Error interno del servidor
        echo "0.00"; // Valor predeterminado si ocurre un error
    }
}

function agregarFondos($usuarioId) {
    $balance = $_POST['balance'];
    if ($balance === null || !is_numeric($balance) || $balance <= 0) {
        echo "Monto inválido.";
        exit;
    }

    $repoUsuario = new RepoUsuario();
    $resultado = $repoUsuario->recargarMonedero($usuarioId, $balance);

    if ($resultado) {
        // Actualizar el saldo en la sesión
        $nuevoSaldo = $repoUsuario->traerMonedero($usuarioId);
        Sesion::escribir('monedero', $nuevoSaldo);
        echo "Fondos agregados exitosamente. Nuevo saldo: " . number_format($nuevoSaldo, 2) . " €";
    } else {
        echo "Error al recargar el monedero.";
    }
}


