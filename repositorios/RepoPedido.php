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

    public function actualizarEstado($idPedido, $nuevoEstado) {
        $stmt = $this->con->prepare("UPDATE Pedido SET estado = :estado WHERE id = :id");
        $stmt->bindParam(':estado', $nuevoEstado, PDO::PARAM_STR);
        $stmt->bindParam(':id', $idPedido, PDO::PARAM_INT);
    
        if (!$stmt->execute()) {
            return false;
        }
    
        
        if ($stmt->rowCount() === 0) {
            return false;
        }
    
        return true;
    }

    public function getPedidosByUsuario($idUsuario){
    // Preparar la consulta para seleccionar solo los campos deseados
    $sql = "SELECT id, nombre, precio_total, fecha_hora, cantidad, estado, direccion 
            FROM Pedido 
            WHERE id_usuario = :idUsuario";
    $stmt = $this->con->prepare($sql);

    // Asociar el parámetro a la consulta
    $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

    // Ejecutar la consulta y manejar errores
    if (!$stmt->execute()) {
        return false;
    }

    // Crear un array para almacenar los pedidos
    $pedidos = [];

    // Recorrer los resultados y convertirlos en objetos Pedido
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pedidos[] = [
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'precio_total' => $row['precio_total'],
            'fecha_hora' => $row['fecha_hora'],
            'cantidad' => $row['cantidad'],
            'estado' => $row['estado'],
            'direccion' => $row['direccion']
        ];
    }

    return $pedidos;
}

    
    

}