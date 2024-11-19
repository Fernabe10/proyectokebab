<?php
class Ingrediente {
    private $id;
    private $nombre;
    private $precio;
    private $descripcion;
    private $foto;

    public function __construct($id, $nombre, $precio, $descripcion, $foto) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->foto = $foto;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFoto() {
        return $this->foto;
    }

    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    // Método para mostrar información del Ingrediente
    public function toString() {
        return "ID: {$this->id} - Nombre: {$this->nombre} - Precio: {$this->precio} - Descripción: {$this->descripcion} - Foto: {$this->foto}";
    }
}
?>
