<?php
class RepoKebab{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function insertarKebab(Kebab $kebab) {
        $stmt = $this->con->prepare("INSERT INTO Kebab (nombre, foto, descripcion, precio_base) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $kebab->getNombre(),
            $kebab->getFoto(),
            $kebab->getDescripcion(),
            $kebab->getPrecioBase()
        ]);
        
        
        $kebabId = $this->con->lastInsertId();
        $kebab->setId($kebabId);

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
                $resultado['foto'],
                $resultado['descripcion'],
                $resultado['precio_base'],
                
                
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

    public function getLastId() {
        
        $stmt = $this->con->prepare("SELECT MAX(id) as ultima_id FROM kebab");
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($resultado && isset($resultado['ultima_id'])) {
            return $resultado['ultima_id'];
        }
    
        
        return null;
    }

    public function getAllKebabs() {
        $stmt = $this->con->prepare("SELECT * FROM kebab");
        $stmt->execute();

        $kebabs = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // devuelvo un array, no un objeto
            $kebabs[] = $row;
        }
        return $kebabs;
    }


}