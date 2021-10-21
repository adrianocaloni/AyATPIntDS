<?php
require_once '.env.php';
require_once 'clases/Usuario.php';

class RepositorioUsuario
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8'); 
        }
    }

    public function login($nombre_usuario, $clave)
    {
        $q = "SELECT id, clave, nombre, apellido FROM usuarios ";
        $q.= "WHERE usuario = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $nombre_usuario);
        if ( $query->execute() ) {
            $query->bind_result($id, $clave_encriptada, $nombre, $apellido);
            if ( $query->fetch() ) {
                if( password_verify($clave, $clave_encriptada) === true) {
                    return new Usuario($nombre_usuario, $nombre, $apellido, $id);
                }
            }
        }
        return false;
    }

    public function save(Usuario $u, $clave)
    {
        $q = "INSERT INTO usuarios (usuario, nombre, apellido, clave) ";
        $q.= "VALUES (?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $query->bind_param("ssss", $u->getUsuario(), $u->getNombre(),
            $u->getApellido(), password_hash($clave, PASSWORD_DEFAULT));

        if ( $query->execute() ) {
            // Retornamos el id del usuario recién insertado.
            return self::$conexion->insert_id;
        }
        else {
            return false;
        }
    }


    // ESTE METODO ME RETORNA EL USUARIO POR SU ID 

    public function get_one($id)
    {
        $q = "SELECT usuario, nombre, apellido FROM usuarios WHERE id = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $id);
        if ( $query->execute() ) {
            $query->bind_result($usuario, $nombre, $apellido);
            if ( $query->fetch() ) { 
                    return new Usuario($usuario, $nombre, $apellido, $id);
            }
        }
        return false;
    }
}
    
