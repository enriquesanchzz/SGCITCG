<?php
include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

//Datos a guardar
$dep=$_POST['departamento'];
$jefe=$_POST['jefe'];
$ext=$_POST['extension'];
$email=$_POST['email'];
$ubicacion=$_POST['ubicacion'];

$sql = "INSERT INTO `departamentos`(`departamento`,`responsable`, `ubicacion`, `email`, `extension`) VALUES ('$dep', '$jefe', '$ubicacion', '$email', '$email')";

if ($db->query($sql) === TRUE) {
    echo "<script type=\"text/javascript\">alert('¡Información del departamento agregada con exito!'); </script>";
    echo "<script type=\"text/javascript\">parent.location.reload();</script>";
} else {
    echo "<script type=\"text/javascript\">alert('¡Usuario eliminado con exito!'); </script>";
    echo "<script type=\"text/javascript\">parent.location.reload();</script>";
}

$db->close();
?>
