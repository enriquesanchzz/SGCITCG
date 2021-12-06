<?php
 include 'include/config.php';
 // Create connection
 $db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
 // Check connection
 if ($db->connect_error) {
     die("¡Error al conectarse!: " . $db->connect_error);
 }

 $cont=0;
 $carpeta = strip_tags($_POST['std']);
 $documentacion = "";
 
    if($carpeta == "docSGC"){
        $documentacion= "Documentación Sistema de Gestión de la Calidad";
    }elseif($carpeta == "docCalidad"){
        $documentacion="Documentación interna Calidad";
    }elseif($carpeta == "docAmbiental"){
        $documentacion="Documentación interna Ambiental";
    }elseif($carpeta == "docEnergia"){
        $documentacion == "Documentación interna Energía";
    }elseif($carpeta == "docOrganizacional"){
        $documentacion = "Documentación Conocimiento Organizacional";
    }elseif($carpeta == "docIgualdad"){
        $documentacion="Documentación interna Igualdad y no Discriminación";
    }elseif($carpeta == "docSalud"){
        $documentacion == "Documentación interna Salud y Seguridad";
    }elseif($carpeta == "docSocial"){
        $documentacion = "Documentación interna Responsabilidad Social";
    }

    session_start();
    $_SESSION['carpeta'] = $carpeta;

?>

<html>
    <head>
        <link rel="stylesheet" href="css/styleProcesos.css">
    </head>
        <body>
        <form action="vistaSubcategoriasDoc.php" name="selectCat" method="POST">
            <h4><?php echo $documentacion ?></h4>
            <h5>Procesos</h5>
            <select name="categoria" id="categoria">
                        <option value="0">Seleccione un proceso:</option>
                        <?php 
                                $query = $db -> query ("select distinct categoria from documentos where carpeta ='".$carpeta."'");
                                while ($row = mysqli_fetch_array($query)) {
                                echo "<option value='$row[categoria]'>$row[categoria]</option>";
                            } ?>
            </select>
            <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
            <div class="row">
                <div class="column">
                    <button type="submit" name="submit" value="submit" id="boton"><img id="std" src="img/check.png"></button>
                    <h6>Siguiente </h6>
                </div>
                <div class="column">
                    <button type="submit" name="agregar" value="agregar"><img id="std" src="img/add.png"></button>
                    <h6>Crear Nuevo Proceso</h6>
                </div>
                <div class="column">
                    <button type="submit" name="cambiarNom" value="cambiarNom" id="boton"><img id="std" src="img/update.png"></button>
                    <h6>Renombrar Proceso Seleccionado</h6>
                </div>
                <div class="column">
                    <button type="submit" name="eliminar" value="eliminar" id="boton"><img id="std" src="img/erase.png"></button>
                    <h6>Eliminar Proceso Seleccionado</h6>
                </div>
        </form>
        
        <form action="CategoriasDocumentacion.php" method="POST">
            <div class="column">
                <button type="submit" name="reiniciar"><img id="std" src="img/restart.png"></button>
                <h6>Reiniciar busqueda</h6>
            </div>
        </form>
            </div>
        </body>
</html>
