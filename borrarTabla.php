<?php
$db = mysqli_connect("localhost", "sigacitc_sgcitcg", "Calidad_1234","sigacitc_sgcitcg");
// Check connection
if ($db->connect_error) {
    die("¡Error al conectarse!: " . $db->connect_error);
    }


 $tabla = "noticias";
// sql to create table
$sql = "DROP TABLE ".$tabla;

if ($db->query($sql) === TRUE) {
  echo "tabla $tabla borrada";
} else {
  echo "Error borrando tabla: " . $db->error;
}

?>