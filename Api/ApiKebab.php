<?php

require_once '../cargadores/autocargador.php';
require_once '../helpers/sesion.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    insertarKebab();
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    traerKebabPorId(); // Otro metodo por si me pasa la id del kebab
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    traerKebabs(); // Si no hay ID, traemos todos los kebabs
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    
}


//Función para insertar un nuevo kebab en la base de datos.

function insertarKebab() {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $foto = null;

  
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoContenido = file_get_contents($_FILES['foto']['tmp_name']);
        $foto = base64_encode($fotoContenido);
    }

    
    $kebab = new Kebab(null, $nombre, $foto, $descripcion, $precio);

   
    $repoKebab = new RepoKebab();
    $kebab = $repoKebab->insertarKebab($kebab);

    // Recojo los ingredientes seleccionados, los recorro y los añado en el kebab
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


//Función para traer todos los kebabs con sus ingredientes.

function traerKebabs() {
    $repoKebab = new RepoKebab();
    $kebabs = $repoKebab->getAllKebabs();

    $resultado = [];
    foreach ($kebabs as $kebab) {
        $repoKebabIngrediente = new RepoKebabIngrediente();
        $ingredientes = $repoKebabIngrediente->getIngredientesByKebabId($kebab['id']);

        $ingredientesList = [];
        $alergenosList = []; 
        $repoAlergeno = new RepoIngredienteAlergeno();

        foreach ($ingredientes as $ingrediente) {
            
            $ingredientesList[] = $ingrediente['nombre'];

            $alergenos = $repoAlergeno->getAlergenosByIngredienteId($ingrediente['id']);
            foreach ($alergenos as $alergeno) {
                // Evito los duplicados con la id del alergeno
                $alergenosList[$alergeno['id']] = $alergeno['nombre'];
            }
        }

        $resultado[] = [
            'id' => $kebab['id'],
            'nombre' => $kebab['nombre'],
            'foto' => $kebab['foto'],
            'descripcion' => $kebab['descripcion'],
            'precio' => $kebab['precio_base'],
            'ingredientes' => $ingredientesList,
            'alergenos' => array_values($alergenosList) // Convierto de array asociativo a lista simple
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($resultado);
}



//Función para traer un kebab específico por su ID.

function traerKebabPorId() {
    $kebabId = intval($_GET['id']);//recoge el valor int de la variable 
    $repoKebab = new RepoKebab();
    $repoKebabIngrediente = new RepoKebabIngrediente();

    $kebab = $repoKebab->buscarPorId($kebabId);
    if (!$kebab) {
        http_response_code(404);
        echo json_encode(['error' => 'Kebab no encontrado']);
        return;
    }

    $ingredientesDelKebab = $repoKebabIngrediente->getIngredientesByKebabId($kebabId);

    $respuesta = [
        'id' => $kebab->getId(),
        'nombre' => $kebab->getNombre(),
        'descripcion' => $kebab->getDescripcion(),
        'precio' => $kebab->getPrecioBase(),
        'foto' => $kebab->getFoto(),
        'ingredientesDelKebab' => $ingredientesDelKebab,
    ];

    echo json_encode($respuesta);
}
