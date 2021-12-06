<?php
include 'include/config.php';
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);

 // Check connection
 if ($db->connect_error) {
     die("¡Error al conectarse!: " . $db->connect_error);
 }
 
 $carpeta = strip_tags($_POST['carpeta']);
 $categoria = strip_tags($_POST['categoria']);
 $subcategoria = strip_tags($_POST['subcategoria']);
 $codigoAct =strip_tags($_POST['codigoAct']);
 $codigo =strip_tags($_POST['codigo']);

 
 $query= "UPDATE documentos SET codigo = '$codigo' WHERE carpeta = '$carpeta' and categoria = '$categoria' and subcategoria = '$subcategoria' and codigo='$codigoAct';";
         if ($db->query($query) === TRUE) {
            echo '<script> alert("Codigo del documento cambiado exitosamente");</script>';
            echo "<script> history.go(-1) ;</script>"; 
            }
            else{ echo '<script> alert("error al cambiar el codigo del archivo");
                </script>';}
?>