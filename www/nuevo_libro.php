<?php
require_once 'clases/Usuario.php';
require_once 'clases/Libro.php';
require_once 'clases/RepositorioLibro.php';

session_start(); //RETOMO EL USUARIO
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);

    //CARGAMOS UN NUEVO LIBRO
    $libro= new Libro ($usuario, $_POST['Titulo'],$_POST['Genero'], $_POST['Autor'], $_POST['Stock']);
    $rl = new RepositorioLibro();
    $numero= $rl-> guardar($libro);

        if ($numero === false){

            header('Location: home.php?mensaje= Error al cargar el Libro');

        }else {
           $libro->setId($numero);
           header('Location: home.php?mensaje= Libro creado exitosamente');
        }

} else {
    header('Location: index.php');
}
?>