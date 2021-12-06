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
$jefe=$_POST['jefe'];
$ext=$_POST['ext'];
$email=$_POST['email'];
$ubi=$_POST['ubi'];

$sql = "UPDATE `departamentos` SET `departamento`='$dep',`responsable`='$jefe',`ubicacion`='$ubi',`email`='$email',`extension`='$ext' WHERE `departamento`='$dep'";

if ($db->query($sql) === TRUE) {
    echo "<script type=\"text/javascript\">alert('¡Información del departamento modificada con exito con exito!'); </script>";
    echo "<script type=\"text/javascript\">parent.location.reload();</script>";
} else {
    echo "Error updating record: " . $db->error;
}

$db->close();
?>
