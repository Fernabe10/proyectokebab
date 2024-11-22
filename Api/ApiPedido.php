<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';


if ($_SERVER['REQUEST_METHOD']=='POST')
{
    agregarPedido();
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
    
}
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
}


function agregarPedido(){
    $usuarioId = Sesion::leer('usuario_id');

    


    $repoPedido = new RepoPedido();
    $pedido = new Pedido($usuarioId, $nombre, $precio_total, $fecha_hora, $cantidad, $estado, $direccion);
    $resultado = $repoPedido->insertarPedido($pedido);

}