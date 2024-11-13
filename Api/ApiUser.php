<?php

require_once '../cargadores/autocargador.php';


if ($_SERVER['REQUEST_METHOD']=='POST')
{
    registrarUsuario();
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
    obtenerUsuarios();
}
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
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

function eliminarUsuario(){
    


}
?>