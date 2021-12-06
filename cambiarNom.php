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
 $codigo = strip_tags($_POST['codigo']);
 $nombre = strip_tags($_POST['nombre']);
 $id_doc = strip_tags($_POST['id_doc']);
 $nombreAct = strip_tags($_POST['nombreAct']);

 
$query= "UPDATE documentos SET nombre = '$nombre' WHERE carpeta='$carpeta' and categoria='$categoria' and codigo='$codigo' AND id_doc='$id_doc' AND nombre='$nombreAct';";
        if ($db->query($query) === TRUE) {
             echo '<script> alert("¡Cambio de nombre realizado con exito!");</script>';
             echo "<script> history.go(-1) ;</script>"; 
            }
            else{ echo '<script> alert("Se sucitó un error al portar los documentos a la nueva subcategoria");
             </script>';}
?>