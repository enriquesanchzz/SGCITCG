<?php
include 'include/config.php';
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);

 // Check connection
 if ($db->connect_error) {
     die("¡Error al conectarse!: " . $db->connect_error);
 }
 
 $carpeta = strip_tags($_POST['carpeta']);
 $categoria = strip_tags($_POST['categoria']);
 $catNewName =strip_tags($_POST['catNewName']);

 rename("files/$carpeta/$categoria", "files/$carpeta/$catNewName");
 
 $query= "UPDATE documentos SET categoria = '$catNewName' WHERE carpeta = '$carpeta' and categoria = '$categoria';";
         if ($db->query($query) === TRUE) {
            echo '<script> alert("Nombre de la categoria cambiado exitosamente");
            </script>';
            }
            else{ echo '<script> alert("error al cambiar el nombre");
                </script>';}

$query= "UPDATE documentos SET ruta = REPLACE(ruta,'$categoria','$catNewName') where carpeta = '$carpeta';";
        if ($db->query($query) === TRUE) {
             echo '<script> alert("Lozalización de los documentos de la categoria modificada satisfactoriamente");"</script>';
             echo "<script> history.go(-1) ;</script>"; 
            }
            else{ echo '<script> alert("Se sucitó un error al portar los documentos a la nueva categoria");
             </script>';}
?>