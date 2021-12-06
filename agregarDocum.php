<?php 
include 'include/config.php';
if(isset($_POST['submit'])){

session_start();
$carpeta = $_SESSION['carpeta'];
$categoria = $_SESSION['categoria'];
$subcategoria = $_SESSION['subcategoria'] ;

$nombre = strip_tags($_POST['nombre']);
$codigo = strip_tags($_POST['codigo']);




$ruta = "files/$carpeta/$categoria/$subcategoria/";
$nombreArchivo = $_FILES['archivo']['name'];
$ruta = $ruta.$nombreArchivo;
move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
// Check connection
if ($db->connect_error) {
    die("¡Error al conectarse!: " . $db->connect_error);
    }

    $query= "INSERT INTO documentos ( nombre, carpeta, categoria, subcategoria, codigo, ruta)
    VALUES ('$nombre','$carpeta', '$categoria', '$subcategoria', '$codigo', '$ruta')";
     if ($db->query($query) === TRUE) {
        echo "<script> alert('Documento agregado exitosamente');</script>";
        echo "<script> history.go(-1) ;</script>"; 
        exit;
        }
        else {
            echo "Error:" . $query . "<br>" . $db->error; 
        }
} ?>