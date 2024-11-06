<?php

require_once '../cargadores/autocargador.php';



$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$monedero = 0.0;
$rol = "cliente";


$usuario = new User(null, $nombre, $contrasena, $correo, $direccion, $monedero, $rol, null);


$repoUsuario = new RepoUsuario();
$resultado = $repoUsuario->insertarUsuario($usuario);


if ($resultado) {
    header("Location: ../index.php");

} else {
    echo "Hubo un error al insertar el usuario.";
}

?>