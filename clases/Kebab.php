<?php
class Kebab{
    private $id;
    private $nombre;
    private $foto;
    private $precio_base;


    public function __construct($id, $nombre, $foto, $precio_base){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->precio_base = $precio_base;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getPrecioBase() {
        return $this->precio_base;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setPrecioBase($precio_base) {
        $this->precio_base = $precio_base;
    }

    
    public function toString() {
        return "ID: {$this->id}, Nombre: {$this->nombre}, Foto: {$this->foto}, Precio Base: {$this->precio_base}";
    }
}
?>