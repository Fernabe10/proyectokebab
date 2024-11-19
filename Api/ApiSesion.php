<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';


if ($_SERVER['REQUEST_METHOD']=='POST')
{
    loginUsuario();
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
    
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
            // Guardar los datos en la sesión
            Sesion::escribir('usuario_id', $usuario->getId());
            Sesion::escribir('usuario', $usuario->getNombre());
            Sesion::escribir('rol', $usuario->getRol());  
            
            header('Location: ../index.php');
            exit;
        } else {
            echo "Credenciales incorrectas";
        }
    }
}
