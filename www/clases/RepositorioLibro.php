<?php
require_once '.env.php';
require_once 'clases/Repositorio.php';
require_once 'clases/Usuario.php';
require_once 'clases/Cuenta.php';

class RepositorioLibro extends Repositorio
{
    
    public function guardar (Libro $libro)  {
        $titulo = $libro->getTitulo();
        $genero = $libro-> getGenero();
        $autor = $libro -> getAutor();
        $idUsuario = $libro-> getIdUsuario();
        $stock = $libro ->getStock();

        $q = "INSERT INTO biblioteca (Titulo, Genero, Autor, Id_Usuario, Stock)";
        $q.= "VALUES (?, ?, ?, ?)";

        try {
 
                $query = self::$conexion->prepare($q);

                $query->bind_param("sssi", $titulo, $genero, $autor, $idUsuario, $stock);

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
        $q = "SELECT ID_Libro, Titulo, Genero, Autor, Stock FROM biblioteca WHERE id_Usuario = ?";

        try {
                $query = self::$conexion->prepare($q);
                $query->bind_param("i", $idUsuario);
                $query->bind_result($numeroLibro, $titulo, $genero, $autor);


                if ($query->execute()){
                    $listaLibros = array();
                        while ($query->fetch()){
                            $listaLibros[] = new Libro($usuario, $titulo, $genero, $autor, $numeroLibro);
                            
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
        $q = "SELECT Titulo, Genero, Autor, id_Usuario, Stock FROM biblioteca WHERE ID_Libro  = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $numeroLibro);
            $query->bind_result($titulo, $genero, $autor,$idUsuario);


            if ($query->execute()) {
                if ($query->fetch()) {
                    $ru = new RepositorioUsuario();
                    $usuario = $ru->get_one($idUsuario);
                    return new Libro($usuario, $titulo, $genero, $autor, $numeroLibro);

                }
            }
            return false;
        } catch(Exception $e) {
            return false;
        }
    }

    public function delete(Libro $libro)
    {
        $n = $libro->getId();
        $q = "DELETE FROM biblioteca WHERE ID_Libro = ?";

        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $n);
        return ($query->execute());
    }


    public function actualizarStock(Cuenta $cuenta)
    {
        $s = $libro-> getStock();
        $n= $libro-> getId();

        $q = "UPDATE biblioteca SET Stok = ? WHERE ID_Libro = ?";

        $query = self::$conexion->prepare($q);
        $query->bind_param("ii", $s, $n);

        return $query->execute();
    }
    
    
    /*public function actualizarGenero(Libro $libro)


        {
            $genero = $libro-> getGenero();
            $numero = $libro-> getId();
    

            $q = "UPDATE biblioteca SET genero = ? WHERE ID_Libro = ?";
            $query = self::$conexion->prepare($q);
            $query->bind_param("si", $genero,  $numero );


            return $query->execute();
        }*/


}
