<?php
include 'include/config.php';
 $tbl_name = "administradores";
 
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);

 if ($db->connect_error) {
 die("La conexion falló: " . $db->connect_error);
}

 $buscarUsuario = "SELECT * FROM $tbl_name
 WHERE usuario = '$_POST[user]' ";

 $result = $db->query($buscarUsuario);

 $count = mysqli_num_rows($result);

 if ($count == 1) {
 echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";

 echo "<a href='index.html'>Por favor escoga otro Nombre</a>";
 }
 else{

 $form_pass = $_POST['password'];
 
 $query = "INSERT INTO administradores (usuario, password)
           VALUES ('$_POST[user]', '$_POST[password]')";

 if ($db->query($query) === TRUE) {
  echo "<script type=\"text/javascript\">alert('¡Usuario creado con exito!'); </script>";
  echo "<script type=\"text/javascript\">parent.location.reload();</script>";
} 
 }
 mysqli_close($db);
?>