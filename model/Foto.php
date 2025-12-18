<?php
class Foto{
    private $fotos_id;
    private $titulo;
    private $descripcion;
    private $ruta;
    public $votos;

    public function __construct($fotos_id=null, $titulo, $descripcion, $ruta){
        $this->fotos_id = $fotos_id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->ruta = $ruta;
        $this->votos = array();
    }
    // Getters
    public function fotos_id(){
        return $this->fotos_id;
    }       
    public function titulo(){
        return $this->titulo;
    }
    public function descripcion(){
        return $this->descripcion;
    }
    public function ruta(){
        return $this->ruta;
    }
    public function agregarVoto($usuarios){
        array_push($this->votos, $usuarios);
        
    }
}

