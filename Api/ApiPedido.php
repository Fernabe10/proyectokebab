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
    
}

function agregarPedido() {


    $usuarioId = Sesion::leer('usuario_id'); // ID del usuario desde la sesión
    if (!$usuarioId) {
        http_response_code(401); // No autorizado
        echo json_encode(['error' => 'El usuario no ha iniciado sesión']);
        return;
    }

    // Obtener la dirección del usuario
    $repoUser = new RepoUsuario();
    $direccion = $repoUser->obtenerDireccionPorId($usuarioId);

    if (!$direccion) {
        http_response_code(400); // Error en la solicitud
        echo json_encode(['error' => 'No se encontró la dirección del usuario']);
        return;
    }

    // Leer los datos enviados en el cuerpo del POST
    $carrito = json_decode(file_get_contents('php://input'), true);

    if (!is_array($carrito) || count($carrito) === 0) {
        http_response_code(400); // Error en la solicitud
        echo json_encode(['error' => 'El carrito está vacío o tiene un formato incorrecto']);
        return;
    }

    $repoPedido = new RepoPedido();

    foreach ($carrito as $producto) {
        $nombre = $producto['nombre'] ?? null;
        $precio_total = $producto['precio_total'] ?? 0;
        $cantidad = $producto['cantidad'] ?? 1;
        $estado = 'Recibido'; // Estado inicial
        $fecha_hora = date('Y-m-d H:i:s'); // Fecha y hora actual

        if (!$nombre) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos obligatorios en el carrito']);
            return;
        }

        // Crear el pedido
        $pedido = new Pedido(null, $usuarioId, $nombre, $precio_total, $fecha_hora, $cantidad, $estado, $direccion);

        // Insertar el pedido en la base de datos
        $resultado = $repoPedido->insertarPedido($pedido);

        if (!$resultado) {
            http_response_code(500); // Error interno
            echo json_encode(['error' => 'No se pudo crear uno de los pedidos']);
            return;
        }
    }

    http_response_code(201); // Creado
    echo json_encode(['mensaje' => 'Todos los pedidos fueron creados correctamente']);
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
