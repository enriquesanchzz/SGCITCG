<?php
session_cache_limiter('private, must-revalidate');
include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
 // Check connection
 if ($db->connect_error) {
     die("¡Error al conectarse!: " . $db->connect_error);
 }

 
 $cont=0;
 $colorbg = null;

session_start();
$carpeta = $_SESSION['carpeta'];
$categoria = $_SESSION['categoria'];
$subcategoria = $_SESSION['subcategoria'] ;


if(!isset($_SESSION['subcategoria'])){
$sub = strip_tags($_POST['subcategoria']);
$_SESSION['subcategoria'] = $sub; 
$subcategoria = $_SESSION['subcategoria'];
}
 
 if(isset($_POST['submit'])){
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
    }else{ $colorbg =  "#c7bf8f";}


?>

<html>
    <head>
    <link rel="stylesheet" href="css/styleDocumentacion.css">
    </head>
        <body>
        <form action="CategoriasDocumentacion.php" name="selectCat" method="POST">
            <?php
            echo "<input type='text' name='categoria' placeholder='Procedimiento: $categoria' disabled>";
            echo "<input type='text' name='subcategoria' placeholder='Proceso: $subcategoria' disabled>";
            ?>
        <button type="submit" name="submit">Reiniciar busqueda</button>
        </form>

        <form action="MostrarDoc.php"  name="selectCat" method="POST">
            Dar clic despues de cada documento agregado
            <input type='hidden' name='categoria' value='<?php echo $categoria ?>'>
            <input type='hidden' name='subcategoria' value='<?php echo $subcategoria ?>'>
            <input type='hidden' name='carpeta' value='<?php echo $carpeta?>'>
            <button type="submit" name="submit">Refrescar pagina</button>
        </form>

        <table id="datos" cellpadding=2 cellspacing=1 border="1px">
            <tr>
                <td bgcolor='<?php echo $colorbg ?>' colspan="6" style="text-align:center;"><h4>Procedimiento --> <?php echo $categoria ?></h4></td>
           </tr>
           <tr>
           <td bgcolor='<?php echo $colorbg ?>' colspan="6" style="text-align:center;"><h4>Procesos --> <?php echo $subcategoria ?></h4></td>
           </tr>
            <tr>
                <td width="20px"><h1>ID</h1></td>
                <td width="450px"><h1>Nombre del arcivo</h1></td>
                <td width="180px"><h1>Modificar codigo</h1></td>
                <td width="200px"><h1>Modificar archivo</h1></td>
                <td width="200px"><h1>Modificar nombre del archivo</h1></td>
                <td width="25px"><h1>Eliminar</h1></td>
            </tr>
                
            <?php 
                $sql = "select id_doc, nombre, codigo, ruta from documentos where carpeta='".$carpeta."' and categoria='".$categoria."' and subcategoria='".$subcategoria."'";
                $resultado = $db->query($sql);    
                while($row = $resultado->fetch_array())
                    {
                        $id = $row['id_doc'];
                        $nombre = $row['nombre'];
                        $codigo = $row['codigo'];
                        $ruta = $row['ruta'];
                        $cont++;
            ?>


            <tr>
                <td bgcolor='<?php echo $colorbg ?>' style="text-align:center;"><h1><?php echo $cont; ?></h1> </td>
                <td bgcolor='<?php echo $colorbg ?>'><a href="<?php echo $row['ruta']; ?>"target="_blank"><h1><?php echo  $row['nombre']," [ ", $codigo, " ]"; ?></h1></a></td>
                            <td>
                                <form method='post' action='cambiarCodDoc.php' enctype='multipart/form-data'>
                                    <label for="codigo">Nuevo código: </label>
                                    <input type='text' name='codigo' id='nombre'>
                                    <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
                                    <input type="hidden" name="codigoAct" value='<?php echo $codigo; ?>'>
                                    <input type="hidden" name="categoria" value='<?php echo $categoria; ?>'>
                                    <input type="hidden" name="subcategoria" value='<?php echo $subcategoria; ?>'>
                                    <input type='submit' name='cambiarCod' id='cambiarCod' value='Modificar código'>
                                </form>
                            </td>
                            <td>
                                <form method='post' action='cambiarArchivo.php' enctype='multipart/form-data'>
                                    <input type='file' name='archivo' value="Seleccionar">
                                    <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
                                    <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>
                                    <input type="hidden" name="rutaArchivo" value='<?php echo $rutaArchivo; ?>'>
                                    <input type="hidden" name="categoria" value='<?php echo $categoria; ?>'>
                                    <input type="hidden" name="subcategoria" value='<?php echo $subcategoria; ?>'>
                                    <input type='submit' name='cambiarArch' value='Actualizar Documento' >
                                </form>
                            </td>
                            <td>
                               <form method='post' action='cambiarNom.php' enctype='multipart/form-data'>
                                    <label for="nombre">Nuevo nombre: </label>
                                    <input type='text' name='nombre' id='nombre'>
                                    <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
                                    <input type="hidden" name="nombreAct" value='<?php echo $nombre; ?>'>
                                    <input type="hidden" name="id_doc" value='<?php echo $id; ?>'>
                                    <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>
                                    <input type="hidden" name="categoria" value='<?php echo $categoria; ?>'>
                                    <input type="hidden" name="subcategoria" value='<?php echo $subcategoria; ?>'>
                                    <input type='submit' name='cambiarNom'  value='Modificar Nombre'>
                                </form>
                            </td>
                            <td style="text-align:center;">
                                <form method='post' action='eliminarArchivo.php' enctype='multipart/form-data'>
                                <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
                                    <input type="hidden" name="categoria" value="<?php echo $categoria ?>">
                                    <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>
                                    <input type='submit' value='Eliminar'>
                                </form>
                            </td>

            </tr>
            <?php
                }
            ?>

            <tr>
                <td bgcolor='<?php echo $colorbg ?>' colspan="6" style="text-align:center;"><h1>Agregar documentación a Procesos --> '<?php echo $subcategoria ?>'</h1></td>
            </tr>
            <tr>
                <td><img src="img/mas.png"></td>
                <form method="post" action="agregarDocum.php" enctype="multipart/form-data">
                    <td> <label>Nombre: </label> <input type="text" REQUIRED name="nombre" id="nombre" ></td>
                    <td> <label>Código: </label> <input type="text" REQUIRED name="codigo" id="codigo" ></td>
                    <td> <input type='file' name='archivo' id='archivo' value="Seleccionar"></td>
                    <input type="hidden" name="categoria" value="<?php echo $categoria ?>">
                    <input type="hidden" name="subcategoria" value="<?php echo $subcategoria ?>">
                    <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
                    <td style="text-align:center;"> <button type='submit' name='submit' onclick="recargarpagina()">Agregar</button></td>
                </form>
                <td><img src="img/mas.png"></td>
            </tr>
            </table>

            
        <form action="MostrarDoc.php"  name="selectCat" method="POST">
            Dar clic despues de cada documento agregado
            <input type='hidden' name='categoria' value='<?php echo $categoria ?>'>
            <input type='hidden' name='subcategoria' value='<?php echo $subcategoria ?>'>
            <input type='hidden' name='carpeta' value='<?php echo $carpeta?>'>
            <button type="submit" name="submit">Refrescar pagina</button>
        </form>
        </body>
</html>

<?php }
if(isset($_POST['borrar'])){
    delete_directory("files/$carpeta/$categoria/$subcategoria");
    $sql = "DELETE FROM documentos WHERE carpeta='$carpeta' and categoria='$categoria' and subcategoria='$subcategoria'";
    if ($db->query($sql) === TRUE) {
        echo "<script> alert('Proceso: $subcategoria ha eliminado de manera exitosamente! del Procedimiento: $categoria');
        window.location.reload(history.back());</script>";
    } else {
        echo "<script> alert('Error al borrar el Proceso');</script>";
    }
        
}
?>

<?php function delete_directory($dirname) {
         if (is_dir($dirname)){
           $dir_handle = opendir($dirname);
         }
         else { return true; }
        if (!$dir_handle){
            return false;
        }
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                    if (!is_dir($dirname."/".$file))
                        unlink($dirname."/".$file);
                    else
                        delete_directory($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
}
?>

<?php 

if(isset($_POST['cambiarNomSub'])){ ?>

<html>
    <head>
    <link rel="stylesheet" href="css/styleDocumentacion.css">
    </head>
        <body>
        <form action="cambiarNomSubCat.php" name="selectCat" method="POST" attribute enctype="multipart/form-data".>
        <table>
        <tr>
                <td bgcolor='#152732' colspan="4" style="text-align:center;"><h4>Cambiar nombre del Procedimiento --> <?php echo $subcategoria ?></h4></td>
           </tr>
            <tr>
                <td width="450px"><h1>Proceso</h1></td>
                <td width="450px"><h1>Procedimiento seleccionado</h1></td>
                <td width="450px"><h1>Nuevo nombre del Procedimiento</h1></td>
                <td width="30px"><h1>Guardar</h1></td>
            </tr>
        <tr>
            </tr>
            <tr>
                    <td><input type="text" name="categoria" value='<?php echo $categoria ?>' disable></td>
                    <td><input type="text" name="subcategoria" value='<?php echo $subcategoria ?>' disable></td>
                    <td><input type="text" name="subCatNewName" placeholder="Nuevo nombre del procedimiento"></td>
                    <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
                    <td style="text-align:center;"> <input type='submit' name='submit' id='submit' value='Guardar'></td>
            </tr>
            </table>
        </form>
        </body>
</html>
<?php } ?>

<?php 

if(isset($_POST['agregarSub'])){ ?>

<html>
    <head>
    <link rel="stylesheet" href="css/styleDocumentacion.css">
    </head>
        <body>
        <form action="agregarSubCat.php" name="selectCat" method="POST" attribute enctype="multipart/form-data".>
        <table>
        <tr>
                <td bgcolor='#152732' colspan="6" style="text-align:center;"><h4>Agregar Procedimiento al Proceso --> <?php echo $categoria ?></h4></td>
           </tr>
            <tr>
                <td width="20px"><h1>Proceso seleccionado</h1></td>
                <td width="450px"><h1>Nueva Procedimiento</h1></td>
                <td width="180px"><h1>Nombre Archivo</h1></td>
                <td width="200px"><h1>Codigo Archivo</h1></td>
                <td width="200px"><h1>Archivo</h1></td>
                <td width="25px"><h1>Agregar</h1></td>
            </tr>
        <tr>
            </tr>
            <tr>
                    <td><input type="text" name="newCat" value='<?php echo $categoria ?>' disable></td>
                    <td><input type="text" name="newSubCat" placeholder="Nombre del Procedimento a crear"></td>
                    <td><input type="text" REQUIRED name="nombre" id="nombre"></td>
                    <td><input type="text" REQUIRED name="codigo" id="codigo"></td>
                    <td><input type="file" name="archivo" id="archivo" value="Seleccionar"></td>
                    <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
                    <td style="text-align:center;"> <input type='submit' name='submit' id='submit' value='Agregar'></td>
            </tr>
            </table>
        </form>

        <form action="CategoriasDocumentacion.php" name="selectCat" method="POST">
            <?php
            echo "<input type='text' name='categoria' placeholder='Procedimiento: $categoria' disabled>";
            echo "<input type='text' name='subcategoria' placeholder='Proceso: $subcategoria' disabled>";
            ?>
        <button type="submit" name="submit">Reiniciar busqueda</button>
        </form>

        

        </body>
</html>
<?php } ?>

