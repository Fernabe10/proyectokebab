<?php
require_once '../cargadores/autocargador.php';

$nombre = $_POST['nombre'];
$alergenos = $_POST['alergenos'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$foto = null;


if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $fotoContenido = file_get_contents($_FILES['foto']['tmp_name']);
    $foto = base64_encode($fotoContenido);
}

$ingrediente = new Ingrediente(null, $nombre, $alergenos, $precio, $descripcion, $foto);

$repoIngrediente = new RepoIngrediente();
$resultado = $repoIngrediente->insertarIngrediente($ingrediente);


?>
