<?php 
include 'include/config.php';
if(isset($_POST['submit'])){

$categoria = strip_tags($_POST['newCat']);
$subCategoriaNew = strip_tags($_POST['newSubCat']);
$carpeta = $_POST['carpeta'];
$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];


mkdir("files/$carpeta/$categoria/$subCategoriaNew/");
$ruta = "files/$carpeta/$categoria/$subCategoriaNew/";
$nombreArchivo = $_FILES['archivo']['name'];
$ruta = $ruta.$nombreArchivo;
move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
// Check connection
if ($db->connect_error) {
    die("¡Error al conectarse!: " . $db->connect_error);
    }

    $query= "INSERT INTO documentos (nombre, carpeta, categoria, subcategoria, codigo, ruta)
    VALUES ('$nombre','$carpeta', '$categoria', '$subCategoriaNew', '$codigo', '$ruta')";
     if ($db->query($query) === TRUE) {
        echo '<script> alert("Categoria crea exitosamente");
        window.location.href="CategoriasDocumentacion.php";
        </script>';
        }
        else {
            echo "Error:" . $query . "<br>" . $db->error; 
        }
}