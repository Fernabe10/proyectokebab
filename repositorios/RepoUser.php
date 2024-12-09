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

    public function getAllUsers() {
        $stmt = $this->con->prepare("SELECT * FROM users");
        $stmt->execute();
        
        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new User(
                $row['id'],
                $row['nombre'],
                $row['contrasena'],
                $row['correo'],
                $row['direccion'],
                $row['monedero'],
                $row['rol'],
                $row['foto']
            );
        }
        
        return $usuarios;
    }

    public function modificarUsuario(User $usuario) {
        $sql = "UPDATE users 
                SET nombre = :nombre, 
                    contrasena = :contrasena, 
                    correo = :correo, 
                    direccion = :direccion, 
                    monedero = :monedero, 
                    rol = :rol";
    
        $params = [
            'nombre' => $usuario->getNombre(),
            'contrasena' => $usuario->getContrasena(),
            'correo' => $usuario->getCorreo(),
            'direccion' => $usuario->getDireccion(),
            'monedero' => $usuario->getMonedero(),
            'rol' => $usuario->getRol(),
            'id' => $usuario->getId(),
        ];
    
        if ($usuario->getFoto()) {
            $sql .= ", foto = :foto";
            $params['foto'] = $usuario->getFoto();
        }
    
        $sql .= " WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($params);
    
        return $stmt->rowCount() > 0;
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

    public function traerMonedero($usuarioId) {
        if (!is_numeric($usuarioId)) {
            throw new InvalidArgumentException("El ID del usuario debe ser un número.");
        }
        $stmt = $this->con->prepare("SELECT monedero FROM users WHERE id = ?");
        $stmt->execute([$usuarioId]);
    
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado['monedero'] : null;
    }

    public function recargarMonedero($usuarioId, $monto) {
        $stmt = $this->con->prepare("UPDATE users SET monedero = monedero + ? WHERE id = ?");
        return $stmt->execute([$monto, $usuarioId]);
    }

    public function obtenerDireccionPorId($idUsuario) {
        $stmt = $this->con->prepare("SELECT direccion FROM users WHERE id = ?");
        $stmt->execute([$idUsuario]);
        $direccion = $stmt->fetchColumn();
        return $direccion;
    }

    public function actualizarMonedero(User $usuario) {
        $sql = "UPDATE users SET monedero = :monedero WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([
            ':monedero' => $usuario->getMonedero(),
            ':id' => $usuario->getId()
        ]);
    }


}
?>