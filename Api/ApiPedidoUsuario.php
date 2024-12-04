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
    
    $idUsuario = Sesion::leer('usuario_id');

    
    $repoPedido = new RepoPedido();
    $pedidos = $repoPedido->getPedidosByUsuario($idUsuario);

    
    $resultado = [];

    
    foreach ($pedidos as $pedido) {
       
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

    
    header('Content-Type: application/json');
    echo json_encode($resultado);
}
