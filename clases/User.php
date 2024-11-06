<?php
class User {
    private $id;
    private $nombre;
    private $contrasena;
    private $correo; 
    private $direccion;
    private $monedero;
    private $rol;
    private $foto;

    public function __construct($id, $nombre, $contrasena, $correo, $direccion, $monedero, $rol, $foto) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
        $this->correo = $correo; 
        $this->direccion = $direccion;
        $this->monedero = $monedero;
        $this->rol = $rol;
        $this->foto = $foto;
    }


    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getMonedero() {
        return $this->monedero;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getFoto() {
        return $this->foto;
    }

    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setMonedero($monedero) {
        $this->monedero = $monedero;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function toString() {
        return "{$this->id} - {$this->nombre} - {$this->contrasena} - {$this->correo} - {$this->direccion} - {$this->monedero} - {$this->rol}";
    }
}
?>
