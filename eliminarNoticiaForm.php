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
        <title> Administrador Noticias </title>
        <link rel="stylesheet" href="css/styleNoticiasEliminar.css">
        <script src="js/documentacion.js" type="text/javascript"></script>
        <link rel="icon" type="image/png" href="img/logo%20itcg.png">
    </head>
    
    <body>
        <div id=cuerpo>
        <!--Seccion de información-->
        <section style="width: 93.7%;">
            <br>
            <div id="noticias" style="align:center; width:95%;">
                <?php
                    $sql = "select * from noticias order by fecha desc";
                    $resultado = $db->query($sql);
                ?>
            <!--Tabla para encabezado -->
            <table  style="width:97%; height: 40px;" border="0" cellspacing="1" cellpadding="10">
                <tr style="text-align: center;">
                    <td style="background-color: #c7bf8f"> <h4>Eliminar Noticia</h4></td>
                </tr>
            </table>
            <br>
            <!--Tabla para el baseado de informacion noticias -->
            <table align="center">
                <?php
                    while($row = $resultado->fetch_array()){
                        $id=$row['id_noticia'];
                        $titulo = $row['titulo'];
                        $noticia = $row['noticia'];
                        $fecha=$row['fecha'];
                        $imagen = $row['imagen'];
                        $archivoNoti = $row['documento'];
                ?>
               <!--titulo -->
                <tr> 
                    <td> <h7><?php echo $row['titulo']; ?></h7></td>
                </tr>
                <tr>
                    <td style="text-align:right;"  width="20px">
                        <form method='post' action='eliminarNoticia.php' enctype='multipart/form-data'>
                            <input type='submit' name='<?php echo $id; ?>' id='<?php echo $id; ?>' value='Eliminar' src="img/eliminar2.png">
                        </form>
				    </td>
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
                  <td width="800px"> <img src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']); ?>"></td>   
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
    </body>
</html>
