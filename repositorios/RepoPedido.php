<?php
class RepoPedido{
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

    public function getAllPedidos() {
        $stmt = $this->con->prepare("SELECT * FROM Pedido");
        
        if (!$stmt->execute()) {
            return false;
        }
        
        $pedidos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pedidos[] = new Pedido(
                $row['id'],
                $row['id_usuario'],
                $row['nombre'],
                $row['precio_total'],
                $row['fecha_hora'],
                $row['cantidad'],
                $row['estado'],
                $row['direccion']
            );
        }
        
        return $pedidos;
    }

}