<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';


if ($_SERVER['REQUEST_METHOD']=='POST')
{
    loginUsuario();
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
    traerDatosUsuarioLogeado();
}
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
}



function loginUsuario()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $repoUsuario = new RepoUsuario();
        $usuario = $repoUsuario->buscarPorCorreo($email);
    
        if ($usuario && $password === $usuario->getContrasena()) { 
            
            Sesion::escribir('usuario_id', $usuario->getId());
            Sesion::escribir('usuario', $usuario->getNombre());
            Sesion::escribir('rol', $usuario->getRol());  
            

            $monedero = $usuario->getMonedero();
            Sesion::escribir('monedero', $monedero);
            
            header('Location: ../index.php');
            exit;
        } else {
            echo "Credenciales incorrectas";
        }
    }
}
function traerDatosUsuarioLogeado()
{
    Sesion::iniciarSesion();
    
    
    if (!Sesion::existe('usuario_id')) {
        http_response_code(401);
        echo json_encode(['error' => 'Usuario no autenticado']);
        return;
    }

    
    $usuarioId = Sesion::leer('usuario_id');
    $repoUsuario = new RepoUsuario();
    $usuario = $repoUsuario->buscarPorId($usuarioId);

    if ($usuario) {
        
        echo json_encode([
            'id' => $usuario->getId(),
            'nombre' => $usuario->getNombre(),
            'correo' => $usuario->getCorreo(),
            'monedero' => $usuario->getMonedero(),
            'rol' => $usuario->getRol(),
            'direccion' => $usuario->getDireccion(),
            'foto' => $usuario->getFoto()
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Usuario no encontrado']);
    }
}

