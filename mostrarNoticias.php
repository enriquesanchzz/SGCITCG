<!-- Conexion a la base de datos -->
<?php
include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    // Check connection
    if ($db->connect_error) {
        die("¡Error al conectarse!: " . $db->connect_error);
    }
?>

<!DOCTYPE html>
<!--Página de para los usuarios Noticias-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Noticias SGC </title>
        <link rel="stylesheet" href="css/styleNoticias.css">
        <script src="js/documentacion.js" type="text/javascript"></script>
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
        <!--Banner decorativo Noticias -->
        <header>
             <img id="bannernoticias" src="img/bannerNoticias.jpg">
        </header>
        <!--Seccion de información-->
        <section style="width: 93.7%; ">
            <br>
            <div id="noticias" style="align:center; width:97%;">
                <?php
                    $sql = "select * from noticias order by fecha desc";
                    $resultado = $db->query($sql);
                    
                    $result = mysqli_query($db,$sql);
                    $count = mysqli_num_rows($result);
      
		
                    if($count < 1) {
                       echo"<script type=\"text/javascript\">alert(' ¡ No hay noticias por mostrar !'); </script>";
                  }
                ?>
            <table  style="width: 85%; height: 3vw;" border="0" cellspacing="0" align="center">
                <tr style="text-align: center;">
                    <td style="background-color: #152732;">  <h5>Noticias </h5></td>
                </tr>
            </table>
            <table align="center">
                <!--Ciclo para basear la información de las noticias-->
                <?php
                    while($row = $resultado->fetch_array()){
                        $id=$row['id_noticia'];
                        $titulo = $row['titulo'];
                        $noticia = $row['noticia'];
                        $fecha=$row['fecha'];
                        $imagen = $row['imagen'];
                        $archivoNoti = $row['documento'];
                ?>
                <!--Titulo de las noticias-->
                <tr> 
                    <td align="center"> <h6><?php echo $row['titulo']; ?></h6></td>
                </tr>
                <!--Fecha de creacion de las noticias-->
                <tr>
                    <td> <h3><?php echo "Fecha de creación: ", $row['fecha']; ?></h3></td>
                </tr>
                            
                <?php
                if(!$imagen==""){
                ?>
                <!--Imagen de la noticia-->
                <tr>
                  <td width="50%" heigh="50%" align="center"> <img src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']); ?>"></td>   
                </tr>
                <?php
                }
                ?>

                 <!--Descripcion de las noticias-->
                <tr>
                    <td color="#292727" width="50%" style="text-align: justify; font-size:2vw;"> <h8><?php echo $row['noticia']; ?></h8></td>
                </tr>                
               
                
                <?php
                if(!$archivoNoti==""){
                ?>
                
                 <!--Archivo de la noticia que se oculta y desoculta-->
                <tr>
                    <td> <li type="none"> <a href="#" onclick="cambiar('<?php echo $archivoNoti; ?>'); return false;" target="_blank"><h1>Ver documento... </h1></a></li>
                        <div id="<?php echo $archivoNoti; ?>" style="display: none; padding-bottom: 2vw;" >
                            <embed src="<?php echo $archivoNoti; ?>" type="application/pdf" width="100%" height="600px" />
                        </div>
                    </td>
                </tr>
                
                <?php
                    }
                ?>
               
                <?php
                }
                ?>
            </table>      
            </div>
            
        </section>
        
        </div>
        
        <!--Pie de página-->
        <footer>
            <!--Panel logo SEP-->
            <div id="pie">
                <div id="img_pie" >
                <img id="sep" src="img/SEP.png" title="DGEST">
                </div>
                
                <!--Panel informacion de contacto-->
                <div id="texto_pie">
                <h1>Tecnológico Nacional de México</h1>
                <h1>Instituto Tecnológico de Ciudad Guzmán</h1>
                <h2>Avenida Tecnológico #100</h2>
                <h2>Ciudad Guzmán, Mpio. de Zapotlán el Grande, Jalisco, México</h2>
                <h3>Teléfono: 01 (341) 575 20 50</h3>
                <h3>Área Calidad: 01 (341) 575 20 66</h3>
                </div>
            </div>
        </footer>
    </body>
</html>