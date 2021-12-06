<?php
include 'include/config.php'; // Conectamos a la base de datos
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
$sql = 'SELECT * FROM administradores';
$consulta = $db->query($sql);
?>


    
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Usuarios Administradores</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  
  <body>
    <div class="main">
      <header>
        <div class="row">
          <div class="col-xs-12">
          </div>
        </div>
      </header>

     
      <div class="row">
        <div class="col-xs-12">
          <h3>Usuarios Adminstradores</h3>
              <!-- Tabla donde se listará la consulta --> 
              <table class="table table-striped"> 
                <thead>
                  <tr>
                    <th width="100">Nombre de Usuario</th>
                  </tr>
                </thead>
                <tbody>
                <!-- Generamos el listado vaciando las variables de la consulta en la tabla -->
                  <?php 
                  while($persona = $consulta->fetch_assoc()) //Creamos un array asociativo con fetch_assoc 
                  {
                  ?>
                    <tr>
                      <td><?php echo $persona['usuario']; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
        </div>
    </div>
    
      </div>
    
    </body>
</html>