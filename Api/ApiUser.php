<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['_method']) && $_POST['_method'] == 'PUT') {
        actualizarUsuario();
    } else {
        registrarUsuario();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    obtenerUsuarios();
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
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
    
    session_start();

    
    $usuarioId = Sesion::leer('usuario_id'); 
    if (!$usuarioId) {
        http_response_code(401);
        echo json_encode(['message' => 'No se ha encontrado un usuario autenticado']);
        return;
    }

    
    if (!isset($_POST['nombre'], $_POST['correo'], $_POST['direccion'], $_POST['password'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Datos incompletos']);
        return;
    }

    
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $contrasena = $_POST['password'];

    
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoContenido = file_get_contents($_FILES['foto']['tmp_name']);
        $foto = base64_encode($fotoContenido);
    }

    
    $repoUsuario = new RepoUsuario();
    $usuario = new User($usuarioId, $nombre, $contrasena, $correo, $direccion, null, null, $foto);
    $resultado = $repoUsuario->modificarUsuario($usuario);

    
    if ($resultado) {
        http_response_code(200);
        echo json_encode(['message' => 'Usuario actualizado correctamente']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Error al actualizar el usuario']);
    }
}


?>