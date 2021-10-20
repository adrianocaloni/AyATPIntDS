<?php
require_once 'clases/Usuario.php';

class Libro 
{
    protected $usuario;
    protected $genero;
    protected $titulo; 
    protected $autor;
    protected $idLibro;

    public function __construct(Usuario $usuario, $genero, $titulo, $autor, $idLibro = null)
    {
        $this->usuario= $usuario;
        $this->genero= $genero;
        $this->titulo= $titulo;
        $this->autor= $autor;
        $this->idLibro= $idLibro;
    }
    

    public function getUsuario() {return $this->usuario;}
    public function getIdUsuario() {return $this->usuario->getId();}
    public function getGenero() {return $this->genero;}
    public function getTitulo() {return $this->titulo;}
    public function getAutor() {return $this->autor;}
    public function getId() {return $this->idLibro;}
    public function setId($id) {$this->idLibro = $id;}

    public function modificarGenero ($nuevoGenero){
        if ($this->genero =! $nuevoGenero){
            $this->genero = $nuevoGenero;
            return true;
        } else {
            return false;
        }
    }
 



    }

