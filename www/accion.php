<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioLibro.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/Libro.php';

session_start();
if (isset($_SESSION['usuario']) && isset($_POST['nombre_Genero'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $rl = new RepositorioLibro();
    $libro = $rc->get_one($_POST['libro']);
    if ($libro->getIdUsuario() != $usuario->getId()) {
        die("Error: La cuenta no pertenece al usuario");
    }

    if ($_POST['tipo'] == 'm') {
        $r = $libro->modificarGenerom($_POST['nombre_Genero']);
    } else if ($_POST['tipo'] == 'a') {
        $r = $libro->actualizarGenero($_POST['nombre_Genero']);
    }
    if ($r) {
        $rl->actualizarGenero($libro);
        $respuesta['resultado'] = "OK";
    } else {
        $respuesta['resultado'] = "Error al realizar la operación";
    }

    $respuesta['numero'] = $libro->getId();
    $respuesta['genero'] = $libro->getGenero();
    echo json_encode($respuesta);
}

