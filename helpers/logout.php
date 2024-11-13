<?php
require_once 'sesion.php';
Sesion::cerrarSesion();
header('Location: ../index.php');