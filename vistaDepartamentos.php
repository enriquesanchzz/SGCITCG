<?php
include 'include/config.php'; // Conectamos a la base de datos
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);	
$sql = 'SELECT * FROM departamentos';
$consulta = $db->query($sql);

?>


<!--HTML de la tabla que despliega la información-->
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jefes de departamento</title>
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
          <h3>Jefes de departamento</h3>
              <!-- Tabla donde se listará la consulta --> 
              <table class="table table-striped"> 
                <thead>
                  <tr>
                    <!--Cabeceras de la tabla-->
                    <th width="100">Departamento</th>
                    <th width="250">Responsable</th>
                    <th width="200">Ubicación</th>
                    <th width="200">Email</th>
                    <th width="200">Extensión</th>
                  </tr>
                </thead>
                <tbody>
                <!-- Vaciado de información a la tabla-->
                  <?php 
                  while($persona = $consulta->fetch_assoc()) //Creamos un array asociativo con fetch_assoc 
                  {
                  ?>
                    <tr>
                      <td><?php echo $persona['departamento']; ?></td>
                      <td><?php echo $persona['responsable']; ?></td>
                      <td><?php echo $persona['ubicacion']; ?></td>
                      <td><?php echo $persona['email']; ?></td>
                      <td><?php echo $persona['extension']; ?></td>
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