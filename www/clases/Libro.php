<?php
require_once 'clases/Usuario.php';

class Libro 
{
    protected $usuario;
    protected $genero;
    protected $titulo; 
    protected $autor;
    protected $stock;
    protected $idLibro;

    public function __construct(Usuario $usuario, $genero, $titulo, $autor, $idLibro = null, $stock)
    {
        $this->usuario= $usuario;
        $this->genero= $genero;
        $this->titulo= $titulo;
        $this->autor= $autor;
        $this->idLibro= $idLibro;
        $this->autor= $stock;
    }
    

    public function getUsuario() {return $this->usuario;}
    public function getIdUsuario() {return $this->usuario->getId();}
    public function getGenero() {return $this->genero;}
    public function getTitulo() {return $this->titulo;}
    public function getAutor() {return $this->autor;}
    public function getId() {return $this->idLibro;}
    public function setId($id) {$this->idLibro = $id;}
    public function getStock() {return $this->stock;}

    public function modificarGenero ($nuevoGenero){

        if ($this->genero != $nuevoGenero) {
            $this->genero = $nuevoGenero;
            return true;
        } else {
            return false;
        }
     
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
    }*/
 
}

