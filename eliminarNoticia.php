<?php
include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    // Check connection
    if ($db->connect_error) {
        die("¡Error al conectarse!: " . $db->connect_error);
    }

	$query="select id_noticia from noticias";
    $resultado=$db->query($query)
    or die("Last error: {$db->error}\n");
     
    while($row = $resultado->fetch_array()){
        $id = $row['id_noticia'];
        //echo $id;
        if (isset($_POST["$id"])) {
           $sql="delete from noticias where id_noticia='$id'";
           $res=$db->query($sql);
           if($res===TRUE){
               echo "<script>
                alert('Noticia eliminada exitosamente');
                parent.location.reload();
                </script>";
           }else{
               echo "<script>
                alert('Noticia NO eliminada');
                parent.location.reload();
                </script>";
           }
        }
    }
?>