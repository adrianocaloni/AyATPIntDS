<?php
require_once 'clases/Usuario.php';
require_once 'clases/Libro.php';
require_once 'clases/RepositorioLibro.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    $rl = new RepositorioLibro();
    $libros = $rl->get_all($usuario);

} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Sistema de Libros</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>

  

    <body class="container">
      <div class="text-center">
            <form method="POST" action="buscar.php" >
            <div class="form-group">
              <label for="doc"></label> 
              <input type="text" name="doc" class="form-control" id="doc">
            </div></br>
              <input type="submit" value="Buscar por Titulo" class="btn btn-info" name="btn2">
            </form>
    
      </br></br>
      <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
        <h3>Listado de Libros</h3> </br>
          <table class="table table-striped">
            <tr>
            <th>Numero de Libro</th><th>Titulo del Libro</th><th>Genero</th><th>Cantidad Disponibles</th><th>Prestar</th><th>Reponer</th><th>Eliminar</th>
            </tr>

            <?php
            if (count($libros)== 0) {
              echo "<tr><td colspan ='8'> No tiene Libros cargados</td></tr>";
            } else {
              foreach ($libros as $unLibro){
                $l = $unLibro->getIdNumer();
                  echo "<tr>";
                  echo "<td>$l</td>";
                  echo "<td>".$unLibro->getTitulo()."</td>";
                  echo "<td>".$unLibro->getGenero()."</td>";
                  echo "<td id ='stock-$l'>".$unLibro->getStock()."</td>";
                  echo "<td><button class='btn btn-outline-success' type='button' onclick='prestar($l)'> <img src='img/modificar.ico'></button></td>";
                  echo "<td><button class='btn btn-outline-success' type='button' onclick='reponer($l)'><img src='img/agregar.ico'></button></td>";
                  echo "<td><a class='btn btn-outline-danger' href='eliminar.php?l=$l' role='button'><img src='img/borrar.ico'></a></td>";
                  echo "<tr>";
              }
            }

            ?>
          </table> </br></br>

          <div id="accion">
            <h4 id="tipo_accion"> Acción</h4>
            <input type="hidden" id="tipo">
            <input type="hidden" id="numeroLibro">

            <label for="cantidad">Cantidad:</label> 
            <input type="number"  id="cantidad"></br></br>
            <button type="button"  class="btn btn-success" onclick="accion();">Realizar Acción</button><br>

          </div><hr>

          <div class="d-grid gap-2">
              <a class="btn btn-primary" href="crear_libro.php">Agregar Libro</a>
              <a class="btn btn-outline-danger" href="logout.php">Cerrar sesión</a>
          </div>
       

        
      </div> 
    </body>


    <script type="text/javascript" src="js/my-app.js"></script>


</html>

