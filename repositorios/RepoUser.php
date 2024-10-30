<?php
class RepoUsuario {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function insertarUsuario(User $usuario) {
        $stmt = $this->con->prepare("INSERT INTO users (nombre, contrasena, direccion, monedero, rol, foto) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $usuario->getNombre(),
            $usuario->getContrasena(),
            $usuario->getDireccion(),
            $usuario->getMonedero(),
            $usuario->getRol(),
            $usuario->getFoto(),
        ]);
        return $usuario;
    }

    public function modificarUsuario(User $usuario) {
        
        $stmt = $this->con->prepare("UPDATE users SET nombre = :nombre, contrasena = :contrasena, direccion = :direccion, monedero = :monedero, rol = :rol, foto = :foto WHERE id = :id");
        
        $stmt->execute([
            'nombre' => $usuario->getNombre(),
            'contrasena' => $usuario->getContrasena(),
            'direccion' => $usuario->getDireccion(),
            'monedero' => $usuario->getMonedero(),
            'rol' => $usuario->getRol(),
            'foto' => $usuario->getFoto(),
            'id' => $usuario->getId(),
        ]);

        return $usuario;
    }

    public function buscarPorId($id) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]); 
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return new User(
                $resultado['id'],
                $resultado['nombre'],
                $resultado['contrasena'],
                $resultado['direccion'],
                $resultado['monedero'],
                $resultado['rol'],
                $resultado['foto']
            );
        } else {
            return null;
        }
    }

    public function eliminarUsuario($id) {
        $stmt = $this->con->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        return $stmt->rowCount() > 0; 
    }



    //ANTIGUOS METODOS PARA COMPROBAR POR PANTALLA

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