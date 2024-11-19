<?php
class RepoAlergeno{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function getAllAlergenos() {
        $stmt = $this->con->prepare("SELECT * FROM alergenos");
        $stmt->execute();
        
        $alergenos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $alergenos[] = new Alergeno(
                $row['id'],
                $row['nombre'],
                $row['descripcion']
            );
        }
        
        return $alergenos;
    }

    public function insertarIngredienteAlergeno($ingredienteId, $alergenoId) {
        $stmt = $this->con->prepare("INSERT INTO ingrediente_alergenos (ingrediente_id, alergeno_id) VALUES (?, ?)");
        return $stmt->execute([$ingredienteId, $alergenoId]);
    }
    
}
?>