<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    registrarUsuario();
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    obtenerUsuarios();
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    actualizarUsuario();
}



function registrarUsuario(){
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $monedero = 0.0;
    $rol = "cliente";


    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoContenido = file_get_contents($_FILES['foto']['tmp_name']);
        $foto = base64_encode($fotoContenido);
    }

    $usuario = new User(null, $nombre, $contrasena, $correo, $direccion, $monedero, $rol, $foto);

    $repoUsuario = new RepoUsuario();
    $resultado = $repoUsuario->insertarUsuario($usuario);

    if ($resultado) {
        header("Location: ../index.php");
    }

}

function obtenerUsuarios(){
    $repoUsuario = new RepoUsuario();
    $usuarios = $repoUsuario->getAllUsers(); 
    
    $resultado = [];
    foreach ($usuarios as $usuario) {
        
        $resultado[] = [
            'id' => $usuario->getId(),
            'nombre' => $usuario->getNombre(),
            'contrasena' => $usuario->getContrasena(),
            'correo' => $usuario->getCorreo(),
            'direccion' => $usuario->getDireccion(),
            'monedero' => $usuario->getMonedero(),
            'rol' => $usuario->getRol(),
            'foto' => $usuario->getFoto()
        ];
    }

   
    header('Content-Type: application/json');
    echo json_encode($resultado);
}

function actualizarUsuario() {
    // Leer el contenido de la solicitud PUT
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Verificar que los datos necesarios estén presentes
    if (!isset($data['id'], $data['nombre'], $data['correo'], $data['direccion'], $data['monedero'], $data['rol'])) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Datos incompletos para la actualización.']);
        return;
    }

    try {
        // Crear la instancia del usuario con los datos proporcionados
        $usuario = new User(
            $data['id'],
            $data['nombre'],
            $data['contrasena'],
            $data['correo'],
            $data['direccion'],
            $data['monedero'],
            $data['rol'],
            isset($data['foto']) ? $data['foto'] : null // Pasar la foto si está incluida, o null si no lo está
        );

        // Llamar al repositorio para actualizar el usuario en la base de datos
        $repoUsuario = new RepoUsuario();
        $resultado = $repoUsuario->modificarUsuario($usuario);

        if ($resultado) {
            http_response_code(200); // OK
            echo json_encode(['mensaje' => 'Usuario actualizado correctamente.']);
        } else {
            http_response_code(500); // Error interno
            echo json_encode(['error' => 'No se pudo actualizar el usuario. Verifica los datos y vuelve a intentarlo.']);
        }
    } catch (Exception $e) {
        error_log("Error al actualizar usuario: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Error al procesar la actualización: ' . $e->getMessage()]);
    }
}





?>