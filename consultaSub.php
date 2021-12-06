<?php
 include 'include/config.php';
 // Create connection
 $db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    // Check connection
    if ($db->connect_error) {
        die("¡Error al conectarse!: " . $db->connect_error);
    }
    $cont=0;
$prove = mysqli_real_escape_string($con, $_POST["categoria"]);
$query = 'select * from documentos where categoria = "'.$prove.'"';
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{
    echo '<option value="' .$row["id"]. '">' .$row["subcategoria"]. '</option>';
}
mysqli_close($con);
?>