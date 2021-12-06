<?php
include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    // Check connection
    if ($db->connect_error) {
        die("¡Error al conectarse!: " . $db->connect_error);
    }
    $carpeta = strip_tags($_POST['carpeta']);
    $seccion = strip_tags($_POST['seccion']);
    ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Documentos <?php echo $seccion ?></title>
        <link rel="stylesheet" href="css/styleDocumentacion.css">
        <link rel="icon" type="image/png" href="img/logo%20itcg.png">
        <script src="js/documentacion.js" type="text/javascript"></script>
    </head>

    <!--Cuerpo -->
    <body>
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
                            <li><a href="https://www.tecnm.mx/informacion/normateca-dgest">Normateca</a></li>
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
         <!--Banner decorativo Documentacion -->
        <header>
             <img id="banner2" src="img/bannerDocumentacion.jpg">
        </header>
            
        <!-- Seccion descarga de archivos -->
            
        <section>
            <!-- Seccion archivos del área de Calidad -->
            <table  style="width: 100%; height: 3vw;" border="0" cellspacing="0" align="center">
                <tr style="text-align: center;">
                    <td style="background-color: #152732;"> <h3>Documentos <?php echo $seccion ?></h3></td>
                </tr>
            </table>
            <br>
            <br>
            <?php 
            $sql1 = "select distinct categoria from documentos where carpeta='$carpeta'";
            $resultadocat = $db->query($sql1);
            while($row1 = $resultadocat->fetch_array()){ 
                $categoria = $row1['categoria'];
                if($categoria == "Calidad"){
                    $colorbg= "#ffe100";
                }elseif($categoria == "Administrativos"){
                    $colorbg="#ff0044";
                }elseif($categoria == "Academicos"){
                    $colorbg="#00918a";
                }elseif($categoria == "Vinculación"){
                    $colorbg == "#009141";
                }elseif($categoria == "Planeación"){
                    $colorbg = "#916a00";
                }else{ $colorbg = "#c7bf8f";}
                
                if($carpeta == "documentos")
                {
                    $cabecera = "Proceso $categoria";
                }
                else{
                    $cabecera = $categoria;
                }
                ?>
            <table  style="width: 100%; height: 3vw;" border="0" cellspacing="0" align="center">
                <tr style="text-align: center;">
                    <td style="background-color: <?php echo $colorbg ?>;"> <h3><?php echo $cabecera ?></h3></td>
                </tr>
            </table>
            <div id="<?php echo $categoria ?>" style="width:100%">
            <?php 
            $sql2 = "select distinct subcategoria from documentos where carpeta='$carpeta' and categoria='$categoria'";
            $resultadosub = $db->query($sql2);
            while($row2 = $resultadosub->fetch_array()){ 
                $subcategoria = $row2['subcategoria'];?>
                <!-- Seccion Manual del Sistema de Gestion de la Calidas (t1) -->
                <li type="none"><a href="#" onclick="cambiar('<?php echo $subcategoria ?>'); return false;" target="_blank"><img hspace="5" vspace="5" align="left" src="img/menu.png"></a><h5><?php echo $subcategoria; ?></h5></li>
                    	<!-- Division de Archivos Gestion de Calidad-->
                        <!--div id="<?php echo $subcategoria ?>" style="display: none;" -->
                            <!-- Consultar de archivo pertenecientes a esta categoria junto ciclo para arrojar los nombres y rutas de los documentos para su descarga -->
                            <?php 
                               $sql = "select nombre from documentos where carpeta='$carpeta' and categoria = '$categoria' and subcategoria='$subcategoria' ";
                                $resultado = $db->query($sql);
                               while($row = $resultado->fetch_array())
                                {
                                    $nombre = $row['nombre'];
                                    $consultaruta = "select ruta, codigo from documentos where carpeta='$carpeta' and categoria = '$categoria' and subcategoria = '$subcategoria' and nombre='$nombre'";
                                    $ruta=$db->query("$consultaruta");
                                    $nombreruta = $ruta->fetch_array();
                                    $rutaArchivo = $nombreruta['ruta'];
                                    $codigo = $nombreruta['codigo'];
                             ?>
                            <ul>
                                <?php 
                                   if(is_file($nombreruta['ruta']))
                                   { ?>
                                    <!-- Abrir archivo de la base de datos mediante el clic en una imagen-->
                                    <li type="circle"><a href="<?php echo $nombreruta['ruta'];?>" target="_blank"><img hspace="5" vspace="5" align="right" src="img/abrir.png"></a><h2><?php echo $row['nombre']," [ ", $codigo, " ]"; ?></h2></li>
                                    <!-- division punteada-->
                                    <hr>
                                <?php
                                   }else{?>
                                    <!-- Abrir archivo de la base de datos mediante el clic en una imagen-->
                                    <li type="circle"><a onclick='alert("No existe archivo adjuntado.");' target="_blank"><img hspace="5" vspace="5" align="right" src="img/abrir.png"></a><h2><?php echo $row['nombre']," [ ", $codigo, " ]"; ?></h2></li>
                                    <!-- division punteada-->
                                    <hr>
                                   <?php
                                    }
                                   ?>
                            </ul>
                            <?php
                                }
                            }
                        }
                            ?>
                        </div>
            </div>   
        </section>
        
        </div>
        <footer>
            <div id="pie">
                <div id="img_pie" >
                <img id="sep" src="img/SEP.png" title="DGEST">
                </div>

                <div id="texto_pie">
                <h1>Tecnológico Nacional de México</h1>
                <h1>Instituto Tecnológico de Ciudad Guzmán</h1>
                <h2>Avenida Tecnológico #100</h2>
                <h2>Ciudad Guzmán, Mpio. de Zapotlán el Grande, Jalisco, México</h2>
                <h11>Teléfono: 01 (341) 575 20 50</h11>
                    <br>
                <h11>Área Calidad: 01 (341) 575 20 66</h11>
                </div>
            </div>
        </footer>
    </body>
</html>
