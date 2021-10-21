<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioLibro.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/Libro.php';

session_start();
if (isset($_SESSION['usuario']) && isset($_POST['cantidad'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $rl = new RepositorioLibro();
    $libro = $rc->get_one($_POST['numeroLibro']);
    if ($libro->getIdUsuario() != $usuario->getId()) {
        die("Error: La cuenta no pertenece al usuario");
    }

    if ($_POST['tipo'] == 'p') {
        $r = $libro->prestar($_POST['cantidad']);
    } else if ($_POST['tipo'] == 'r') {
        $r = $libro->reponer($_POST['cantidad']);
    }
    if ($r) {
        $rl->actualizarStock($libro);
        $respuesta['resultado'] = "OK";
    } else {
        $respuesta['resultado'] = "Error al realizar la operación";
    }

    $respuesta['numero_Libro'] = $libro->getId();
    $respuesta['cant'] = $libro->getStock();
    echo json_encode($respuesta);
}

