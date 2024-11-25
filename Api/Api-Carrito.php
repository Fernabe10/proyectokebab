<?php

// require_once '../cargadores/autocargador.php';
// require_once '../helpers/sesion.php';
// session_start();


// if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//     obtenerCarrito();
// } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     //agregarAlCarrito();
// } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
//     eliminarDelCarrito();
// } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['action']) && $_GET['action'] == 'vaciar') {
//     vaciarCarrito();
// }

// function obtenerCarrito() {
//     // Aquí puedes obtener el carrito desde la sesión o base de datos
//     $usuarioId = Sesion::leer('usuario_id');
//     if (!$usuarioId) {
//         http_response_code(401);
//         echo json_encode(['error' => 'Usuario no autenticado']);
//         return;
//     }

//     $carrito = $_SESSION['carrito'] ?? [];
//     echo json_encode($carrito);
// }

// function agregarAlCarrito() {
//     $data = json_decode(file_get_contents('php://input'), true);
//     $usuarioId = Sesion::leer('usuario_id');
//     if (!$usuarioId) {
//         http_response_code(401);
//         echo json_encode(['error' => 'Usuario no autenticado']);
//         return;
//     }

//     // Almacenar el carrito en la sesión (o base de datos)
//     $carrito = $_SESSION['carrito'] ?? [];
//     array_push($carrito, $data);
//     $_SESSION['carrito'] = $carrito;

//     // Registro en logs (opcional para depuración)
//     error_log(print_r($_SESSION['carrito'], true));

//     echo json_encode(['mensaje' => 'Producto añadido al carrito']);
// }


// function eliminarDelCarrito() {
//     // Obtener el índice del producto a eliminar
//     $data = json_decode(file_get_contents('php://input'), true);
//     $usuarioId = Sesion::leer('usuario_id');
//     if (!$usuarioId) {
//         http_response_code(401);
//         echo json_encode(['error' => 'Usuario no autenticado']);
//         return;
//     }

//     // Eliminar el producto del carrito (almacenado en la sesión)
//     $carrito = $_SESSION['carrito'] ?? [];
//     $carrito = array_filter($carrito, function($item) use ($data) {
//         return $item['nombre'] != $data['nombre'];
//     });
//     $_SESSION['carrito'] = array_values($carrito);  // Reindexar el array
//     echo json_encode(['mensaje' => 'Producto eliminado del carrito']);
// }

// function vaciarCarrito() {
//     $usuarioId = Sesion::leer('usuario_id');
//     if (!$usuarioId) {
//         http_response_code(401);
//         echo json_encode(['error' => 'Usuario no autenticado']);
//         return;
//     }

//     $_SESSION['carrito'] = [];
//     echo json_encode(['mensaje' => 'Carrito vaciado']);
// }
