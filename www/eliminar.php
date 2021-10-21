<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioLibro.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/Libro.php';


session_start();
if (isset($_SESSION['usuario']) && isset($_GET['l'])) {
    
$usuario = unserialize($_SESSION['usuario']);
$rl = new RepositorioLibro();
$libro = $rl->get_one($_GET['l']);

if ($libro->getIdUsuario() != $usuario->getId()){
    header('Error: La cuenta no pertenece al USUARIO');
    }

if($libro->getStock() != 0) {
    header('Location: home.php?mensaje= El Stock disponible no puede ser mayor a 0');
    } else {
        if ($rl->delete($libro)) {
            $mensaje = "Libro eliminado con éxito";
            }else {
            $mensaje = "Error al eliminar la Libro";
            }
            header("Location: home.php?mensaje=$mensaje");    
    } 
} else {
header('Location: index.php');
}
?>