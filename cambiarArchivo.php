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

$ruta = "files/$carpeta/$categoria/$subcategoria/";
$nombreArchivo = $_FILES['archivo']['name'];
$ruta = $ruta.$nombreArchivo;
move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

$query= "UPDATE documentos SET ruta = '$ruta' WHERE carpeta='$carpeta' and codigo='$codigo' and categoria='$categoria' and subcategoria='$subcategoria';";
        if ($db->query($query) === TRUE) {
             echo '<script> alert("¡Cambio de archivo realizado de manera existosa!");</script>';
             echo "<script> history.go(-1) ;</script>"; 
            }
            else{ echo '<script> alert("Se sucitó un error al portar los documentos a la nueva subcategoria");
             </script>';}
?>