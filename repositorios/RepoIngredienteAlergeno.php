<?php
class RepoIngredienteAlergeno {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function getAlergenosByIngredienteId($ingredienteId) {
        $sql = "
            SELECT a.id, a.nombre
            FROM alergenos a
            JOIN ingrediente_alergenos ia ON a.id = ia.alergeno_id
            WHERE ia.ingrediente_id = ?
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$ingredienteId]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
