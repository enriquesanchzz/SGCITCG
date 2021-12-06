<?php
$db = mysqli_connect("localhost", "sigacitc_sgcitcg", "Calidad_1234","sigacitc_sgcitcg");
// Check connection
if ($db->connect_error) {
    die("¡Error al conectarse!: " . $db->connect_error);
    }


 
// sql to create table
$sql = "CREATE TABLE noticias (
id_noticia INT(10) AUTO_INCREMENT PRIMARY KEY,
titulo VARCHAR(50) NOT NULL,
noticia VARCHAR(4000) NOT NULL,
fecha VARCHAR(20) NOT NULL,
imagen longblob,
documento VARCHAR(200)
)";

if ($db->query($sql) === TRUE) {
  echo "Table documentos created successfully";
} else {
  echo "Error creating table: " . $db->error;
}

?>