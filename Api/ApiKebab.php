<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';

// Seleccionamos la acción según el método HTTP
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    insertarKebab();
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    traerKebabPorId(); // Si se pasa un ID, traemos un kebab específico
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    traerKebabs(); // Si no hay ID, traemos todos los kebabs
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Implementar eliminación si es necesario
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Implementar actualización si es necesario
}

/**
 * Función para insertar un nuevo kebab en la base de datos.
 */
function insertarKebab() {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $foto = null;

    // Procesamos la foto si se ha enviado
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoContenido = file_get_contents($_FILES['foto']['tmp_name']);
        $foto = base64_encode($fotoContenido);
    }

    // Creamos un objeto Kebab
    $kebab = new Kebab(null, $nombre, $foto, $descripcion, $precio);

    // Insertamos el kebab
    $repoKebab = new RepoKebab();
    $kebab = $repoKebab->insertarKebab($kebab);

    // Procesamos los ingredientes seleccionados
    $ingredientesSeleccionados = json_decode($_POST['ingredientes_seleccionados']);
    if ($ingredientesSeleccionados) {
        $repoKebabIngrediente = new RepoKebabIngrediente();
        foreach ($ingredientesSeleccionados as $ingredienteNombre) {
            $repoIngrediente = new RepoIngrediente();
            $ingrediente = $repoIngrediente->obtenerIngredientePorNombre($ingredienteNombre);

            if ($ingrediente) {
                $cantidad = 1; // Por defecto, cantidad es 1
                $repoKebabIngrediente->insertarKebabIngrediente($kebab->getId(), $ingrediente->getId(), $cantidad);
            }
        }
    }
}

/**
 * Función para traer todos los kebabs con sus ingredientes.
 */
function traerKebabs() {
    $repoKebab = new RepoKebab();
    $kebabs = $repoKebab->getAllKebabs();

    $resultado = [];
    foreach ($kebabs as $kebab) {
        $repoKebabIngrediente = new RepoKebabIngrediente();
        $ingredientes = $repoKebabIngrediente->getIngredientesByKebabId($kebab['id']);

        $ingredientesList = [];
        foreach ($ingredientes as $ingrediente) {
            $ingredientesList[] = $ingrediente['nombre'];
        }

        $resultado[] = [
            'id' => $kebab['id'],
            'nombre' => $kebab['nombre'],
            'foto' => $kebab['foto'],
            'descripcion' => $kebab['descripcion'],
            'precio' => $kebab['precio_base'],
            'ingredientes' => $ingredientesList
        ];
    }

    echo json_encode($resultado);
}

/**
 * Función para traer un kebab específico por su ID.
 */
function traerKebabPorId() {
    $kebabId = intval($_GET['id']);
    $repoKebab = new RepoKebab();
    $repoKebabIngrediente = new RepoKebabIngrediente();

    // Obtenemos el kebab
    $kebab = $repoKebab->buscarPorId($kebabId);
    if (!$kebab) {
        http_response_code(404);
        echo json_encode(['error' => 'Kebab no encontrado']);
        return;
    }

    // Obtenemos los ingredientes del kebab
    $ingredientesDelKebab = $repoKebabIngrediente->getIngredientesByKebabId($kebabId);

    // Construimos la respuesta
    $response = [
        'id' => $kebab->getId(),
        'nombre' => $kebab->getNombre(),
        'descripcion' => $kebab->getDescripcion(),
        'precio' => $kebab->getPrecioBase(),
        'foto' => $kebab->getFoto(),
        'ingredientesDelKebab' => $ingredientesDelKebab, // Solo los ingredientes del kebab
    ];

    echo json_encode($response);
}
