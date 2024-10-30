<?php
class RepoUsuario{
    private $con;

    //Constructor que usa la clase conexion para tener la conexion
    public function __construct(){
        $this->con = Conexion::getConection();
    }

    




















    //METODOS PARA COMPROBAR POR PANTALLA

    // //Método para obtener un array de los usuarios
    // public function getAllUsers(){
    //     $users = [];

    //     try{
    //         $sql = "SELECT id, nombre, contrasena, direccion, monedero, rol, foto FROM users";
    //         $stmt = $this->con->prepare($sql);
    //         $stmt->execute();

    //         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //             $users[] = new User($row['id'], $row['nombre'], $row['contrasena'], $row['direccion'], $row['monedero'], $row['rol'], $row['foto']);
    //         }
    //     }catch (PDOException $e) {
    //         echo "Error al obtener los usuarios: " . $e->getMessage();
    //     }
    //     return $users;
    // }

    // public function findById($id) {
    //     $usuario = null;
    
    //     try {
    //         $stm = $this->con->prepare("SELECT * FROM users WHERE id = :id");
    //         $stm->execute([':id' => $id]);
    //         $registro = $stm->fetch(PDO::FETCH_ASSOC);
    
    //         if ($registro) {
    //             // Crear un nuevo objeto User con los datos recuperados
    //             $usuario = new User($registro['id'], $registro['nombre'], $registro['contrasena'], $registro['direccion'], $registro['monedero'], $registro['rol'], $registro['foto']);
    //         }
    //     } catch (PDOException $e) {
    //         echo "Error al buscar el usuario por ID: " . $e->getMessage();
    //     }
    
    //     return $usuario;
    // }


}
?>