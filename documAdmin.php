<?php
include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    // Check connection
    if ($db->connect_error) {
        die("¡Error al conectarse!: " . $db->connect_error);
    }
    $cont=0;
   
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Administración de Documentos del SGC </title>
        <link rel="stylesheet" href="css/styleDocumentacion.css">
        <link rel="icon" type="image/png" href="img/logo%20itcg.png">
        <script src="js/documentacion.js" type="text/javascript"></script>
        <script src="js/ventana.js" type="text/javascript"></script>
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
                     <li><a href="indexAdmin.html">Inicio</a></li>
                     <li><a href="noticiasAdmin.html">Noticias</a></li> 
                     <li>
                        <a href="documAdmin.php">Documentación</a>
                     </li>
                     <li><a href="usuariosAdmin.html">Usuarios</a></li>
                     <li><a href="contactoAdmin.html">Departamentos</a></li>
                     <li><a href="logout.php">Log out</a></li>
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
        
        <br>
        <br>

        <div id="Container" style="padding-bottom:56.25%; position:relative; display:block; width: 100%">
        <iframe src="CategoriasDocumentacion.php"  
                name="lista" scrolling="auto" id="principal"
                frameborder="1" width="100%" height="100%" style="position:absolute; top:0; left: 0"> 
        </iframe>
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
