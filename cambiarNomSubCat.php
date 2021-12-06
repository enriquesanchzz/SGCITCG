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
 $subcategoriaNew =strip_tags($_POST['subCatNewName']);

 rename("files/$carpeta/$categoria/$subcategoria", "files/$carpeta/$categoria/$subcategoriaNew");
 
 $query= "UPDATE documentos SET subcategoria = '$subcategoriaNew' WHERE carpeta = '$carpeta' and categoria = '$categoria' and subcategoria = '$subcategoria';";
         if ($db->query($query) === TRUE) {
            echo '<script> alert("Nombre de la subcategoria cambiado exitosamente");
            </script>';
            }
            else{ echo '<script> alert("error al cambiar el nombre");
                </script>';}

$query= "UPDATE documentos SET ruta = REPLACE(ruta,'$subcategoria','$subcategoriaNew') where carpeta = '$carpeta';";
        if ($db->query($query) === TRUE) {
             echo '<script> alert("Lozalización de los documentos de la subcategoria modificada satisfactoriamente");
             </script>';
             echo "<script> history.go(-1) ;</script>"; 
            }
            else{ echo '<script> alert("Se sucitó un error al portar los documentos a la nueva subcategoria");
             </script>';}
?>