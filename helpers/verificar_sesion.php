<?php

require_once 'login.php';

session_start();


$usuarioAutenticado = Login::UsuarioEstaLogueado();

echo json_encode(['autenticado' => $usuarioAutenticado]);
?>