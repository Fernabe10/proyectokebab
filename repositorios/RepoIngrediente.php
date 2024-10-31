<?php
class RepoIngrediente{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function insertarIngrediente(Ingrediente $ingrediente) {
        $stmt = $this->con->prepare("INSERT INTO Ingrediente (nombre, alergenos, precio, descripcion, foto) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $ingrediente->getNombre(),
            $ingrediente->getAlergenos(),
            $ingrediente->getPrecio(),
            $ingrediente->getDescripcion(),
            $ingrediente->getFoto(),
        ]);
        return $ingrediente;
    }

    public function modificarIngrediente(Ingrediente $ingrediente) {
        
        $stmt = $this->con->prepare("UPDATE Ingrediente SET nombre = :nombre, alergenos = :alergenos, precio = :precio, descripcion = :descripcion, foto = :foto WHERE id = :id");
        
        $stmt->execute([
            'nombre' => $ingrediente->getNombre(),
            'alergenos' => $ingrediente->getAlergenos(),
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
                $resultado['alergenos'],
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
}
?>