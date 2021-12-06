<?php
include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

//Datos a guardar
$user=$_POST['user'];


$sql = "DELETE FROM `administradores` WHERE usuario='$user'";

if ($db->query($sql) === TRUE) {
    echo "<script type=\"text/javascript\">alert('¡Usuario eliminado con exito!'); </script>";
    echo "<script type=\"text/javascript\">parent.location.reload();</script>";
} else {
    echo "<script type=\"text/javascript\">alert('Error eliminando contacto, ¡Usuario no existe!'); </script>" ;
    echo "<script type=\"text/javascript\">parent.location.reload();</script>";
}

$db->close();
?>
