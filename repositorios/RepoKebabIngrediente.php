<?php
class RepoKebabIngrediente {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function insertarKebabIngrediente($kebabId, $ingredienteId, $cantidad) {
        try {
            $sql = "INSERT INTO kebab_ingrediente (kebab_id, ingrediente_id, cantidad) VALUES (:kebab_id, :ingrediente_id, :cantidad)";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([
                ':kebab_id' => $kebabId,
                ':ingrediente_id' => $ingredienteId,
                ':cantidad' => $cantidad
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al insertar en kebab_ingrediente: " . $e->getMessage());
        }
    }

    
    public function getAllIngredientes() {
        $stmt = $this->con->query("SELECT id, nombre FROM Ingrediente");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getIngredientesByKebabId($kebabId) {
        $stmt = $this->con->prepare("
            SELECT i.id, i.nombre
            FROM Ingrediente i
            JOIN kebab_ingrediente ki ON i.id = ki.ingrediente_id
            WHERE ki.kebab_id = ?
        ");
        $stmt->execute([$kebabId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // array asociativo con id y nombre
    }
}

            
?>