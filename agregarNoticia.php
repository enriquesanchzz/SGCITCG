<?php
include 'include/config.php';
if(isset($_POST['agregar'])) {
    
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    // Check connection
    if ($db->connect_error) {
        die("¡Error al conectarse!: " . $db->connect_error);
    }

global $titulo, $texto, $featured_image, $target;
$titulo = strip_tags($_POST['titulo']);
$texto = strip_tags($_POST['cuerpo']);

$featured_image = $_FILES['imagen']['tmp_name'];

if(empty($featured_image)) { echo "Es preferible agregar una imagen <br>";}
else { $featured_image = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));}

$featured_doc = $_FILES['archivo']['name'];
if (empty($featured_doc)) { echo "Es preferible agregar un documento <br>"; }
else{
	  	$target = "archivosNoticias/" . basename($featured_doc);
	  	if (!move_uploaded_file($_FILES['archivo']['tmp_name'], $target)) {
	  		echo "Falla al subir el archivo, seleccione un PDF <br>";
	  	}
}

date_default_timezone_set('America/Mexico_City');
$date = date('d-m-Y H:i:s');

$query= "INSERT INTO noticias ( `titulo`, `noticia`, `fecha`, `imagen`, `documento`) VALUES ('$titulo', '$texto', '$date', '$featured_image', '$target')";

if($db->query($query)==TRUE){
    echo "<script>alert('Noticia publicada de manera correcta');
    parent.location.reload();
    </script>";
}else{
    echo "Error:" . $query . "<br>" . $db->error;
    echo "<script>alert('Lo sentimos, la noticia no pudo ser publicada, intentelo de nuevo')
    </script>";
    
}

mysqli_close($db);
}
?>