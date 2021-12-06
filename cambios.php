<?php
$db = mysqli_connect("localhost", "sigacitc_sgcitcg", "Calidad_1234","sigacitc_sgcitcg");
// Check connection
if ($db->connect_error) {
    die("¡Error al conectarse!: " . $db->connect_error);
    }


 
$result = mysqli_query($db, 'DESCRIBE noticias');
while($row = mysqli_fetch_assoc($result)) {
    echo "{$row['Field']} - {$row['Type']}\n";
}

?>