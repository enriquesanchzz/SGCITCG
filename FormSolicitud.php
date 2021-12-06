<!DOCTYPE html>
<!--Página para realizar solicitudes de mantenimiento-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Estandares de Calidad del ITCG </title>
        <link rel="stylesheet" href="css/styleSolicitud.css">
        <link rel="icon" type="image/png" href="img/logo%20itcg.png">
    </head>
    <body>
        
        <!--Banner TNM-->
        <header>
            <img id="banner" src="img/banner.jpg">
        </header>
        
        <div id=cuerpo>
    <!-- Menu de navegación-->
        <nav class="margin-bottom">
           <p class="nav-text">Custom menu text</p>
               <div class="top-nav s-12 l-10">
                 <ul>
                     <li>
                         <a href="index.html">Sistemas de Gestión</a>
                         <ul>
                            <li><a href="9001.html">Calidad</a></li>
                            <li><a href="14001.html">Ambiental</a></li>
                            <li><a href="50001.html">Energía</a></li>
                            <li><a href="45001.html">Salud y Seguridad</a></li>
                            <li><a href="26000.html">Responsabilidad Social</a></li>
                            <li><a href="igualdad.html">Igualdad y no discriminación</a></li>
                         </ul>
                    </li>
                     <li><a href="mostrarNoticias.php">Noticias</a></li>
                     <li><a href="FormSolicitud.php">Solicitudes</a></li>
                     <li><a href="login.html">Administrador</a></li>
                  </ul>
               </div>
               <div class="hide-s hide-m l-2">
                  <i class="icon-facebook_circle icon2x right padding"></i>
               </div>
        </nav>
        
        <header>
             <img id="banner2" src="img/bannerSolicitudes.jpg">
        </header>
        <section>
            <!--Forma donde se recolectan los datos de la solicitud-->
            <form action="solicitud.php" method="post" enctype="multipart/form-data" >
                
                    <div class="solicitud">
                         <select id="departamentos" name="departamentos">
                         <?php

                            include 'include/config.php';
                            // Create connection
                            $db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
                            // Check connection
                            if ($db->connect_error) {
                                die("¡Error al conectarse!: " . $db->connect_error);
                            } 

                            echo '<option value="0" disable> Seleccione una opción: </option>';

                            // Realizamos la consulta para extraer los datos
                            $query = $db -> query ("select * from departamentos");
                            while ($valores = mysqli_fetch_array($query)) {
                            // En esta sección estamos llenando el select con datos extraidos de una base de datos.
                             echo '<option value="'.$valores['departamento'].'">'.$valores['departamento'].'</option>';
                             $depa = $valores['departamento'];
                             $responsable = $valores['responsable'];
                              }
                        ?>
                        </select>
                        <label>Agregar un archivo complementario a la solicitud</label>
                        <input type="file" name="archivo">
                      
                        
                        
                    </div>
                
                <div class="contacto">
                    <div class="row">
                        <input type="text" name="areaRemitente" size="50" placeholder="Área del solicitante" required>
                        <input type="text" name="solicitante" size="50" placeholder="Solicitante" required>
                        <input type="text" name="email" size="50" placeholder="Correo Electrónico" required>
                        <input type="text" name="fecha" size="10" value="" id="fecha" disabled>
                        <script type="text/javascript">
                            n =  new Date();
                            y = n.getFullYear();
                            m = n.getMonth() + 1;
                            d = n.getDate();
                            document.getElementById("fecha").value = (d + "/" + m + "/" + y);
                        </script>
                        
                        <textarea id="descripcion "name="descripcion" rows="10" cols="50" placeholder="Escriba aquí los detalles de su solicitud" required></textarea>
                        <button type="submit" name="submit">Enviar</button>
                    </div>
                </div>
                
                
                <div class="column">
                    <div class="row">
                    
                    </div>
                </div>
                
            </form>
        </section>
        
        </div>
        
        <!--Pie de página-->
        <footer>
            <div id="pie">
                <!--Panel logo SEP-->
                <div id="img_pie" >
                <img id="sep" src="img/SEP.png" title="DGEST">
                </div>

                <!--Panel información de contacto-->
                <div id="texto_pie">
                <h1>Tecnológico Nacional de México</h1>
                <h1>Instituto Tecnológico de Ciudad Guzmán</h1>
                <h2>Avenida Tecnológico #100</h2>
                <h2>Ciudad Guzmán, Mpio. de Zapotlán el Grande, Jalisco, México</h2>
                <h3>Teléfono: 01 (341) 575 20 50</h3>
                <h3>Fax: 01 (341) 575 20 74</h3>
                </div>
            </div>
        </footer>
    </body>
</html>

