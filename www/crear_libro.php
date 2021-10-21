<?php
require_once 'clases/Usuario.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Bienvenido al sistema</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema bibliotecario</h1>
      </div>    
      <div class="text-center">
        <h3>Cargar Libro</h3>

        <form action="nuevo_libro.php" method="post">
            <input name="Titulo" id= "titulo" class="form-control form-control-lg" placeholder="Titulo"><br>
            <input name="Genero" id= "genero" class="form-control form-control-lg" placeholder="Genero"><br>
            <input name="Stock" id= "stock" class="form-control form-control-lg" placeholder="Stock"><br>
            <input type="submit" value="Guardar Libro" class="btn btn-primary">
        </form>        
      </div> 
    </body>
</html>
