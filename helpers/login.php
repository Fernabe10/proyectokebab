<?php
class Login
{

    public static function UsuarioEstaLogueado()
    {
        return isset($_SESSION['usuario_id']);
    }
}