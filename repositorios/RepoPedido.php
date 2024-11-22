<?php
class RepoKebab{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function insertarPedido(Pedido $pedido) {
        $stmt = $this->con->prepare("INSERT INTO Pedido (id_usuario, nombre, precio_total, fecha_hora, cantidad, estado, direccion)
                                     VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $pedido->getIdUsuario(),
            $pedido->getNombre(),
            $pedido->getPrecioTotal(),
            $pedido->getFechaHora(),
            $pedido->getCantidad(),
            $pedido->getEstado(),
            $pedido->getDireccion(),
        ]);
        
        return $pedido;
    }

}