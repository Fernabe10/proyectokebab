<?php
class Pedido {
    private $id;
    private $id_usuario;
    private $nombre;
    private $precio_total;
    private $fecha_hora;
    private $cantidad;
    private $estado;
    private $direccion;

    public function __construct($id, $id_usuario, $nombre, $precio_total, $fecha_hora, $cantidad, $estado, $direccion) {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->precio_total = $precio_total;
        $this->fecha_hora = $fecha_hora;
        $this->cantidad = $cantidad;
        $this->estado = $estado;
        $this->direccion = $direccion;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecioTotal() {
        return $this->precio_total;
    }

    public function getFechaHora() {
        return $this->fecha_hora;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPrecioTotal($precio_total) {
        $this->precio_total = $precio_total;
    }

    public function setFechaHora($fecha_hora) {
        $this->fecha_hora = $fecha_hora;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
}
?>
