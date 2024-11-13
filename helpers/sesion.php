<?php
class Sesion
{
    public static function iniciarSesion(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function leer(string $clave){
        self::iniciarSesion(); 
        return $_SESSION[$clave] ?? null;
    }

    public static function existe(string $clave): bool {
        self::iniciarSesion(); 
        return isset($_SESSION[$clave]);
    }

    public static function escribir(string $clave, $valor){
        self::iniciarSesion(); 
        $_SESSION[$clave] = $valor;
    }

    public static function eliminar(string $clave){
        self::iniciarSesion();
        unset($_SESSION[$clave]);
    }

    public static function cerrarSesion(){
        self::iniciarSesion();
        session_unset();      
        session_destroy();
    }
}
