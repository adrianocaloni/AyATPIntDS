<?php
require_once '.env.php';
require_once 'clases/Repositorio.php';
require_once 'clases/Usuario.php';
require_once 'clases/Libro.php';

class RepositorioLibro extends Repositorio
{
    
    public function guardar (Libro $libro)  {
        
        $idUsuario = $libro-> getIdUsuario();
        $titulo = $libro->getTitulo();
        $genero = $libro-> getGenero();
        $stock = $libro ->getStock();
        
  

        $q = "INSERT INTO biblioteca ( Titulo, Genero, Stock, id_Usuario) VALUES (?, ?, ?, ?)";

        try {
 
                $query = self::$conexion->prepare($q);

                $query->bind_param("ssii", $titulo, $genero, $stock, $idUsuario);

                    //VAMOS A INTENTAR EJECUTAR LA CONSULTA (QUERY)
                        if ($query->execute()){

                            return self::$conexion->insert_id;

                        } else {
                            return false;
                        }
            } catch (Exception $e){

                return false;

               } 
    }

    public function get_all(Usuario $usuario){

        $idUsuario = $usuario ->getId();
        $q = "SELECT   ID_Libro, Titulo, Genero, Stock FROM biblioteca WHERE id_Usuario = ?";

        try {
                $query = self::$conexion->prepare($q);
                $query->bind_param("i", $idUsuario);
                $query->bind_result($numeroLibro, $titulo, $genero, $stock);


                if ($query->execute()){
                    $listaLibros = array();
                        while ($query->fetch()){
                            $listaLibros[] = new Libro($usuario, $titulo, $genero, $stock, $numeroLibro);
                            
                        }
                        return $listaLibros;
                }
                return false;
        } catch(Exception $e){
            return false;
        }
  
    }
    
    public function get_one($numeroLibro)
    {
        $q = "SELECT Titulo, Genero, Stock, id_Usuario FROM biblioteca WHERE ID_Libro  = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $numeroLibro);
            $query->bind_result($titulo, $genero, $stock, $idUsuario);


            if ($query->execute()) {
                if ($query->fetch()) {
                    $ru = new RepositorioUsuario();
                    $usuario = $ru->get_one($idUsuario);
                    return new Libro($usuario, $titulo, $genero, $stock, $numeroLibro);

                }
            }
            return false;
        } catch(Exception $e) {
            return false;
        }
    }

    public function delete(Libro $libro)
    {
        $n = $libro->getIdNumer();
        $q = "DELETE FROM biblioteca WHERE ID_Libro = ?";

        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $n);
        return ($query->execute());
    }

    public function actualizarStock(Libro $libro)
   
    {
        $s = $libro->getStock();
        $n=  $libro->getIdNumer();
       

        $q = "UPDATE biblioteca SET Stock = ? WHERE ID_Libro = ?";

        $query = self::$conexion->prepare($q);
        $query->bind_param("ii", $n, $s);

        return $query->execute();
    }
    
    
  /*  public function buscar($nombre)
    
    {
        
        $q = "SELECT Titulo, Genero, Stock, id_Usuario FROM biblioteca WHERE Titulo  = $nombre";


        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("s", $titulo);
            $query->bind_result($numeroLibro, $titulo, $genero, $stock);

            if ($query->execute()){
                $listaLibros = array();
                    while ($query->fetch()){
                        $listaLibrosBuscados[] = new Libro($usuario, $titulo, $genero, $stock, $numeroLibro);
                        
                    }
                    return $listaLibrosBuscados;
            }
                return false;
        } catch(Exception $e){
            return false;
    }

  
    }*/
   

}
