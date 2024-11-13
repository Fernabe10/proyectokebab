<?php
class RepoUsuario {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConection();
    }

    public function insertarUsuario(User $usuario) {
        $stmt = $this->con->prepare("INSERT INTO users (nombre, contrasena, correo, direccion, monedero, rol, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $usuario->getNombre(),
            $usuario->getContrasena(),
            $usuario->getCorreo(),
            $usuario->getDireccion(),
            $usuario->getMonedero(),
            $usuario->getRol(),
            $usuario->getFoto(),
        ]);
        return $usuario;
    }

    public function modificarUsuario(User $usuario) {
        
        $stmt = $this->con->prepare("UPDATE users SET nombre = :nombre, contrasena = :contrasena, correo = :correo, direccion = :direccion, monedero = :monedero, rol = :rol, foto = :foto WHERE id = :id");
        
        $stmt->execute([
            'nombre' => $usuario->getNombre(),
            'contrasena' => $usuario->getContrasena(),
            'correo' => $usuario->getCorreo(),
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
                $resultado['correo'],
                $resultado['direccion'],
                $resultado['monedero'],
                $resultado['rol'],
                $resultado['foto']
            );
        } else {
            return null;
        }
    }

    public function buscarPorCorreo($correo) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE correo = :correo LIMIT 1");
        $stmt->execute(['correo' => $correo]);
    
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($resultado) {
            return new User(
                $resultado['id'],
                $resultado['nombre'],
                $resultado['contrasena'],
                $resultado['correo'],
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



    


}
?>