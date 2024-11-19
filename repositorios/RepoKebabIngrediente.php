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
    
}
?>