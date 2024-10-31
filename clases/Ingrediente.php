<?php
class Ingrediente {
    private $id;
    private $nombre;
    private $alergenos;
    private $precio;
    private $descripcion;
    private $foto;

    public function __construct($id, $nombre, $alergenos, $precio, $descripcion, $foto) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->alergenos = $alergenos;
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

    public function getAlergenos() {
        return $this->alergenos;
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

    public function setAlergenos($alergenos) {
        $this->alergenos = $alergenos;
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
        return "ID: {$this->id} - Nombre: {$this->nombre} - Alergenos: {$this->alergenos} - Precio: {$this->precio} - Descripción: {$this->descripcion} - Foto: {$this->foto}";
    }
}
?>
