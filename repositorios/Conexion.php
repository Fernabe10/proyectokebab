<?php
class Conexion {
    private static $con = null;

    public static function getConection() {
        if (self::$con === null) {
            try {
                self::$con = new PDO("mysql:host=localhost;dbname=proyectokebab", 'root', 'root');
            } catch (PDOException $e) {
                echo "Error al conectar a la base de datos: " . $e->getMessage();
            }
        }
        return self::$con;
    }
}
?>
