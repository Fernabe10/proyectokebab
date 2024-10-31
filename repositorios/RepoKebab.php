<?php
class RepoKebab{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function insertarKebab(Kebab $kebab) {
        $stmt = $this->con->prepare("INSERT INTO Kebab (nombre, foto, precio_base) VALUES (?, ?, ?)");
        $stmt->execute([
            $kebab->getNombre(),
            $kebab->getFoto(),
            $kebab->getPrecioBase()
        ]);
        return $kebab;
    }

    public function modificarKebab(Kebab $kebab) {
        
        $stmt = $this->con->prepare("UPDATE Kebab SET nombre = :nombre, precio_base = :precio_base , foto = :foto WHERE id = :id");
        
        $stmt->execute([
            'nombre' => $kebab->getNombre(),
            'precio_base' => $kebab->getPrecioBase(),
            'foto' => $kebab->getFoto(),
            'id' => $kebab->getId(),
        ]);

        return $kebab;
    }

    public function buscarPorId($id) {
        $stmt = $this->con->prepare("SELECT * FROM Kebab WHERE id = :id");
        $stmt->execute(['id' => $id]); 
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return new Kebab(
                $resultado['id'],
                $resultado['nombre'],
                $resultado['precio_base'],
                $resultado['foto'],
            );
        } else {
            return null;
        }
    }

    public function eliminarKebab($id) {
        $stmt = $this->con->prepare("DELETE FROM Kebab WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        return $stmt->rowCount() > 0; 
    }

}