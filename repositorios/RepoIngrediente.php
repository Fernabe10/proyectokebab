<?php
class RepoIngrediente{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function insertarIngrediente(Ingrediente $ingrediente) {
        $stmt = $this->con->prepare("INSERT INTO Ingrediente (nombre, precio, descripcion, foto) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $ingrediente->getNombre(),
            $ingrediente->getPrecio(),
            $ingrediente->getDescripcion(),
            $ingrediente->getFoto()
        ]);
        return $ingrediente;
    }

    public function modificarIngrediente(Ingrediente $ingrediente) {
        
        $stmt = $this->con->prepare("UPDATE Ingrediente SET nombre = :nombre, precio = :precio, descripcion = :descripcion, foto = :foto WHERE id = :id");
        
        $stmt->execute([
            'nombre' => $ingrediente->getNombre(),
            'precio' => $ingrediente->getPrecio(),
            'descripcion' => $ingrediente->getDescripcion(),
            'foto' => $ingrediente->getFoto(),
            'id' => $ingrediente->getId(),
        ]);

        return $ingrediente;
    }

    public function buscarPorId($id) {
        $stmt = $this->con->prepare("SELECT * FROM Ingrediente WHERE id = :id");
        $stmt->execute(['id' => $id]); 
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return new Ingrediente(
                $resultado['id'],
                $resultado['nombre'],
                $resultado['precio'],
                $resultado['descripcion'],
                $resultado['foto']
            );
        } else {
            return null;
        }
    }

    public function eliminarIngrediente($id) {
        $stmt = $this->con->prepare("DELETE FROM Ingrediente WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        return $stmt->rowCount() > 0; 
    }

    public function getLastId() {
        
        $stmt = $this->con->prepare("SELECT MAX(id) as ultima_id FROM Ingrediente");
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($resultado && isset($resultado['ultima_id'])) {
            return $resultado['ultima_id'];
        }
    
        
        return null;
    }

    public function getAllIngredientes() {
        $stmt = $this->con->prepare("SELECT id, nombre, precio, descripcion, foto FROM Ingrediente");
        $stmt->execute();
    
        $ingredientes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ingredientes[] = new Ingrediente(
                $row['id'],
                $row['nombre'],
                $row['precio'],
                $row['descripcion'],
                $row['foto']
            );
        }
    
        return $ingredientes;
    }

    public function obtenerIngredientePorNombre($nombre) {
        $stmt = $this->con->prepare("SELECT * FROM Ingrediente WHERE nombre = :nombre");
        $stmt->execute(['nombre' => $nombre]);
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return new Ingrediente(
                $resultado['id'],
                $resultado['nombre'],
                $resultado['precio'],
                $resultado['descripcion'],
                $resultado['foto']
            );
        } else {
            return null; // Si no se encuentra el ingrediente
        }
    }
    
}
?>