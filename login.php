<?php

include 'include/config.php';
// Create connection
$db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
   
   session_start();


   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['user']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM administradores WHERE usuario = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
     
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
           echo"<script type=\"text/javascript\">alert(' ¡ Bienvenido . $user . !'); </script>";
         header("location: indexAdmin.html");
      }else {
         echo"<script type=\"text/javascript\">alert('Nombre de usuario o contraseña incorrectos'); </script>";
            header("location: login.html");
      }
   }
?>