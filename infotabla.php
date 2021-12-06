<?php
$db = mysqli_connect("localhost", "sigacitc_sgcitcg", "Calidad_1234","sigacitc_sgcitcg");
// Check connection
if ($db->connect_error) {
    die("¡Error al conectarse!: " . $db->connect_error);
    }

 
$sql = "SHOW TABLES FROM `sigacitc_sgcitcg`;";
$res = mysqli_query($db, $sql);
 
if($res !== false){
 
    $FILE = fopen("output.csv", "w");
 
    $tables = array();
    while($row = mysqli_fetch_array($res)){
       $tables[] = $row['0'];
    }
 
    foreach($tables as $table) {
        $columns = array();
        $res = mysqli_query($db, "SHOW COLUMNS FROM `$table`;");
 
        while($row = mysqli_fetch_array($res, MYSQL_NUM)) {
            $columns[] = $row['0'];
        }
 
        fwrite($FILE, implode(",", $columns) . "\n");
        $resTable = mysqli_query($db, "SELECT * FROM `$table`;");
 
        while($row = mysqli_fetch_array($resTable, MYSQL_NUM)) {
            fwrite($FILE, implode(",", $row) . "\n");
        }
    }
 
    fclose($FILE);
}else{
    die(mysqli_error($db));
}
 
mysqli_close($db);
?>