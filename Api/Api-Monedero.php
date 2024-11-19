<?php
require_once '../helpers/sesion.php';
require_once '../cargadores/autocargador.php';

// Iniciar la sesión antes de cualquier operación
Sesion::iniciarSesion();

if (!Sesion::existe('usuario_id')) {
    echo json_encode(["success" => false, "message" => "Usuario no autenticado."]);
    exit;
}

// Obtener el usuario ID de la sesión
$usuarioId = Sesion::leer('usuario_id');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    agregarFondos($usuarioId);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    traerMonedero($usuarioId);
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
    exit;
}

function agregarFondos($usuarioId) {
    $balance = $_POST['balance'];
    if ($balance === null || !is_numeric($balance) || $balance <= 0) {
        echo json_encode(["success" => false, "message" => "Monto inválido."]);
        exit;
    }

    $repoUsuario = new RepoUsuario();
    $resultado = $repoUsuario->recargarMonedero($usuarioId, $balance);

    if ($resultado) {
        echo json_encode(["success" => true, "message" => "Fondos agregados exitosamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al recargar el monedero."]);
    }
}

function traerMonedero($usuarioId) {
    $repoUsuario = new RepoUsuario();
    $monedero = $repoUsuario->traerMonedero($usuarioId);

    if ($monedero !== null) {
        echo json_encode(["success" => true, "saldo" => $monedero]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al obtener el saldo del monedero."]);
    }
}

?>


