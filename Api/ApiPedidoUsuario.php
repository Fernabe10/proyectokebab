<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';

if ($_SERVER['REQUEST_METHOD']=='POST')
{

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



function traerPedidos() {
    // Obtener la ID del usuario desde la sesión
    $idUsuario = Sesion::leer('usuario_id');

    // Crear el objeto RepoPedido y obtener los pedidos del usuario
    $repoPedido = new RepoPedido();
    $pedidos = $repoPedido->getPedidosByUsuario($idUsuario);

    // Inicializar el array de resultados
    $resultado = [];

    // Recorrer los pedidos y agregar los datos al array de resultados
    foreach ($pedidos as $pedido) {
        // Aquí no es necesario llamar a métodos como getNombre(), porque ya tienes los datos en el array
        $resultado[] = [
            'id' => $pedido['id'],
            'nombre' => $pedido['nombre'],
            'precio_total' => $pedido['precio_total'],
            'fecha_hora' => $pedido['fecha_hora'],
            'cantidad' => $pedido['cantidad'],
            'estado' => $pedido['estado'],
            'direccion' => $pedido['direccion']
        ];
    }

    // Devolver los resultados en formato JSON
    header('Content-Type: application/json');
    echo json_encode($resultado);
}
