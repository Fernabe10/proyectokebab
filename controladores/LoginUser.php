<?php
require_once '../cargadores/autocargador.php'; 
session_start();

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$repoUsuario = new RepoUsuario();
$usuario = $repoUsuario->buscarPorCorreo($correo);

if ($usuario && $contrasena == $usuario->getContrasena()) {
    $_SESSION['usuario_id'] = $usuario->getId();
    $_SESSION['nombre'] = $usuario->getNombre();
    echo "Usuario encontrado, bienvenido.";
} else {
    echo "Correo o contraseña incorrectos.";
}
?>
