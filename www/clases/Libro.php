<?php
require_once 'clases/Usuario.php';

class Libro 
{
    protected $usuario;
    protected $genero;
    protected $titulo; 
    protected $stock;
    protected $idLibro;

    public function __construct(Usuario $usuario, $genero, $titulo, $stock, $idLibro = null)
    {
        $this->usuario= $usuario;
        $this->genero= $genero;
        $this->titulo= $titulo;
        $this->stock= $stock;
        $this->idLibro= $idLibro;
        
    }
    
  

    public function getUsuario() {
        return $this->usuario;
    }

    public function getIdUsuario() {
        return $this->usuario->getId();
    }

    public function getGenero() {
        return $this->genero;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    
     public function getStock() {
        return $this->stock;
    }
    public function setStock($s) {
        $this->stock = $s;
    }
    public function getIdNumer() {
        return $this->idLibro;
    }
    public function setIdNumer($id) {
        $this->idLibro = $id;
    }
    


    public function prestar($cantidad)
    {
        if ($this->stock >= $cantidad) {
            $this->stock = $this->stock - $cantidad;
            return true;
        } else {
            return false;
        }
    }

    public function reponer($cantidad)
    {
        $this->stock = $this->stock + $cantidad;
        return true;
    }
    
    /*public function agregarGenero ($nuevoGenero){
       
        $this->genero = $this->genero + $nuevoGenero;
        return true;
 
    }

    
    public function  buscarGenero($buscarGenero){
        if ($this->genero == $buscarGenero) {
            return true;
        } else {
            return false;
        }
    }
        public function modificarGenero ($nuevoGenero){

        if ($this->genero != $nuevoGenero) {
            $this->genero = $nuevoGenero;
            return true;
        } else {
            return false;
        }
     
    }
    */
 
}

