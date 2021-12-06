<?php
include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
// Check connection
if ($db->connect_error) {
    die("¡Error al conectarse!: " . $db->connect_error);
}
$cont=0;
$categoria = strip_tags($_POST['categoria']);


session_start();
$_SESSION['categoria'] = $categoria;
$_SESSION['subcategoria'] = null;
$carpeta = $_SESSION['carpeta'];


if(isset($_POST['submit'])) {
 
?>

<html>
    <head>
        <link rel="stylesheet" href="css/styleProcesos.css">
    </head>
        <body>
        <form action="MostrarDoc.php" name="selectCat" method="POST">
            <h5>Proceso</h5>
            <input type='text' name='cat' id='cat' placeholder='<?php echo $categoria ?>' disabled >
            <input type="hidden" name="categoria" value='<?php echo $categoria; ?>'>
            <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
            <h5>Procedimientos</h5>
            <select name="subcategoria" id="subcategoria">
                        <option value="0">Seleccione un Procedimiento:</option>
                        <?php 
                                $query = $db -> query ("select distinct subcategoria from documentos where carpeta='".$carpeta."' and categoria='".$categoria."'");
                                while ($row = mysqli_fetch_array($query)) {
                                echo "<option value='$row[subcategoria]'>$row[subcategoria]</option>";
                            } 
                            ?>
            </select>
            <div class="row">
                <div class="column">
                    <button type="submit" name="submit" value="submit"><img id="std" src="img/check.png"></button>
                    <h6>Siguiente</h6>
                </div>
                <div class="column">
                    <button type="submit" name="agregarSub" value="agregarSub"id="boton"><img id="std" src="img/add.png"></button>
                    <h6>Crear Nuevo Procedimiento</h6>
                </div>
                <div class="column">
                    <button type="submit" name="cambiarNomSub" value="cambiarNomSub"><img id="std" src="img/update.png"></button>
                    <h6>Renombrar Procedimiento Seleccionado</h6>
                </div>
                <div class="column">
                    <button type="submit" name="borrar" value="borrar"><img id="std" src="img/erase.png"></button>
                    <h6>Eliminar Procedimiento Seleccionado</h6>
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

<?php } 

if(isset($_POST['agregar'])){ ?>

<html>
    <head>
    <link rel="stylesheet" href="css/styleDocumentacion.css">
    </head>
        <body>
        <form action="agregarCat.php" name="selectCat" method="POST" attribute enctype="multipart/form-data".>
        <table>
        <tr>
                <td bgcolor='#c7bf8f' colspan="6" style="text-align:center;"><h4>Agregar Proceso</h4></td>
           </tr>
            <tr>
                <td width="20px"><h1>Nuevo Proceso</h1></td>
                <td width="450px"><h1>Nuevo Procedimiento</h1></td>
                <td width="180px"><h1>Nombre Archivo</h1></td>
                <td width="200px"><h1>Codigo Archivo</h1></td>
                <td width="200px"><h1>Archivo</h1></td>
                <td width="25px"><h1>Agregar</h1></td>
            </tr>
        <tr>
            </tr>
            <tr>
                    <td><input type="text" name="newCat" placeholder="Nombre del Proceso a crear"></td>
                    <td><input type="text" name="newSubCat" placeholder="Nombre del Procedimiento a crear"></td>
                    <td><input type="text" REQUIRED name="nombre" id="nombre"></td>
                    <td><input type="text" REQUIRED name="codigo" id="codigo"></td>
                    <td><input type="file" name="archivo" id="archivo" value="Seleccionar"></td>
                    <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
                    <td style="text-align:center;"> <input type='submit' name='submit' id='submit' value='Agregar'></td>
            </tr>
            </table>
        </form>
        </body>
</html>
<?php } ?>



<?php if(isset($_POST['eliminar'])){
    delete_directory("files/$carpeta/$categoria");
    $sql = "DELETE FROM documentos WHERE carpeta='$carpeta' and categoria='$categoria'";
    if ($db->query($sql) === TRUE) {
        echo "<script> alert('Procedimiento eliminado exitosamente: $categoria');
        window.location.reload(history.back());</script>";
    } else {
        echo "<script> alert('Error al borrar el procedimiento');</script>";
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

if(isset($_POST['cambiarNom'])){ ?>

<html>
    <head>
    <link rel="stylesheet" href="css/styleDocumentacion.css">
    </head>
        <body>
        <form action="cambiarNomCat.php" name="selectCat" method="POST" attribute enctype="multipart/form-data".>
        <table>
        <tr>
                <td bgcolor='#c7bf8f' colspan="3" style="text-align:center;"><h4>Cambiar nombre al Proceso --> <?php echo $categoria ?></h4></td>
           </tr>
            <tr>
                <td width="450px"><h1>Proceso seleccionado</h1></td>
                <td width="450px"><h1>Nuevo nombre</h1></td>
                <td width="30px"><h1>Guardar</h1></td>
            </tr>
        <tr>
            </tr>
            <tr>
                    <td><input type="text" name="categoria" value='<?php echo $categoria ?>' disable></td>
                    <td><input type="text" name="catNewName" placeholder="Nuevo nombre de la categoria"></td>
                    <input type="hidden" name="carpeta" value='<?php echo $carpeta; ?>'>
                    <td style="text-align:center;"> <input type='submit' name='submit' id='submit' value='Guardar'></td>
            </tr>
            </table>
        </form>
        </body>
</html>
<?php } ?>
