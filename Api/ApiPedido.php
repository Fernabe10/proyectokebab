<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    agregarPedido();
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
    traerPedidos();
}
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    actualizarEstado();
}

function agregarPedido() {
    $usuarioId = Sesion::leer('usuario_id');
    if (!$usuarioId) {
        http_response_code(401);
        echo json_encode(['error' => 'El usuario no ha iniciado sesión']);
        return;
    }

    $repoUser = new RepoUsuario();
    $usuario = $repoUser->buscarPorId($usuarioId);

    if (!$usuario) {
        http_response_code(400);
        echo json_encode(['error' => 'No se encontró información del usuario']);
        return;
    }

    $monedero = $usuario->getMonedero();
    $direccion = $usuario->getDireccion();

    if (!$direccion) {
        http_response_code(400);
        echo json_encode(['error' => 'No se encontró la dirección del usuario']);
        return;
    }

    // Leer los datos enviados en el cuerpo del POST
    $carrito = json_decode(file_get_contents('php://input'), true);

    if (!is_array($carrito) || count($carrito) === 0) {
        http_response_code(400);
        echo json_encode(['error' => 'El carrito está vacío o tiene un formato incorrecto']);
        return;
    }

    // Calculo el precio total del pedido
    $precioTotalPedido = array_reduce($carrito, function ($suma, $producto) {
        return $suma + ($producto['precio_total'] ?? 0);
    }, 0);

    // Valido si el monedero tiene saldo suficiente
    if ($monedero < $precioTotalPedido) {
        http_response_code(400);
        echo json_encode(['error' => 'Saldo insuficiente en el monedero']);
        return;
    }

    $repoPedido = new RepoPedido();

    // Recojo los datos del pedido
    foreach ($carrito as $producto) {
        $nombre = $producto['nombre'] ?? null;
        $precio_total = $producto['precio_total'] ?? 0;
        $cantidad = $producto['cantidad'] ?? 1;
        $estado = 'Recibido'; //Le pongo estado recibido por defecto
        $fecha_hora = date('Y-m-d H:i:s'); // Fecha y hora actual

        if (!$nombre || $precio_total <= 0 || $cantidad <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos obligatorios o los valores no son válidos']);
            return;
        }

        //Aqui los inserto
        $pedido = new Pedido(null, $usuarioId, $nombre, $precio_total, $fecha_hora, $cantidad, $estado, $direccion);

        
        $resultado = $repoPedido->insertarPedido($pedido);

        if (!$resultado) {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear uno de los pedidos']);
            return;
        }
    }

    // Resto el precio total del pedido del monedero del usuario
    $nuevoSaldo = $monedero - $precioTotalPedido;
    $usuario->setMonedero($nuevoSaldo);
    $repoUser->actualizarMonedero($usuario);

    http_response_code(201); 
    echo json_encode([
        'mensaje' => 'Todos los pedidos fueron creados correctamente',
        'nuevo_saldo' => $nuevoSaldo
    ]);
}


function traerPedidos(){
    $repoPedido = new RepoPedido();
    $pedidos = $repoPedido->getAllPedidos(); 
    
    $resultado = [];
    foreach ($pedidos as $pedido) {
        
        $resultado[] = [
            'id' => $pedido->getId(),
            'id_usuario' => $pedido->getIdUsuario(),
            'nombre' => $pedido->getNombre(),
            'precio_total' => $pedido->getPrecioTotal(),
            'fecha_hora' => $pedido->getFechaHora(),
            'cantidad' => $pedido->getCantidad(),
            'estado' => $pedido->getEstado(),
            'direccion' => $pedido->getDireccion()
        ];
    }

   
    header('Content-Type: application/json');
    echo json_encode($resultado);
}

function actualizarEstado(){
    // Obtengo los datos del cuerpo de la solicitud PUT
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id']) && isset($data['estado'])) {
        $idPedido = $data['id'];
        $nuevoEstado = $data['estado'];

        
        $repoPedido = new RepoPedido();

       
        $resultado = $repoPedido->actualizarEstado($idPedido, $nuevoEstado);

        if ($resultado) {
            
            echo json_encode(['status' => 'success', 'message' => 'Estado del pedido actualizado correctamente.']);
        } else {
            
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el estado del pedido.']);
        }
    } else {
        
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos. Se requiere id y estado.']);
    }
}
