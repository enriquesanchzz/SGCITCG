<?php
include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

//Datos a guardar
$dep=$_POST['dep'];


$sql = "DELETE FROM `departamentos` WHERE departamento='$dep'";

if ($db->query($sql) === TRUE) {
    echo "<script type=\"text/javascript\">alert('¡Información del departamento eliminada con exito!'); </script>";
    echo "<script type=\"text/javascript\">parent.location.reload();</script>";
} else {
    echo "<script type=\"text/javascript\">alert('¡No se pudo eliminar la información del departamento!'); </script>";
    echo "<script type=\"text/javascript\">parent.location.reload();</script>";
}

$db->close();
?>
