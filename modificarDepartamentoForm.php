<html>
    <body>
        <link rel="stylesheet" href="css/styleAdministrador.css">
        <form method="POST" action="modificarDepartamento.php">
            <?php
            include 'include/config.php';
            //variables de para agregar a la tabla
            $Nom=$_POST['Nombre'];
            
            // Create connection
            $db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
            // Check connection
            if ($db->connect_error) {
                die("¡Error al conectarse!: " . $db->connect_error);
                }
                


                $sql="select * from departamentos where departamento='$Nom'";
                if ($db->query($sql) == FALSE) {
                echo"<script type=\"text/javascript\">alert('No existe registro con ese nombre'); window.location='modificarContacto.html';</script>";
                }
                else{
                $result = $db->query($sql);
                $numfilas = $result->num_rows;

                echo "<center>";
                for ($x=0;$x<$numfilas;$x++) {
                $fila = $result->fetch_object();
                    

                echo "<label for = \"Nombre\"> Departamento: </label><input type = \"text\" name = \"dep\" value = \"$fila->departamento\">";
                echo "<br/>";
                echo "<label for = \"Jefe\"> Responsable: </label><input type = \"text\" name = \"jefe\" value = \"$fila->responsable\">";
                echo "<br/>";
                echo "<label for = \"Extension\"> Ubicación: </label><input type = \"text\" name = \"ubi\" value = \"$fila->ubicacion\">";
                echo "<br/>";
                echo "<label for = \"Email\"> Email: </label><input type = \"email\" name = \"email\" value = \"$fila->email\">";
                echo "<br/>";
                echo "<label for = \"ubi\"> Extensión: </label><input type = \"number\" name = \"ext\" value = \"$fila->extension\">";

                }
                echo "</center>";
                }
                //$db->close();
                $db->close();
            ?>
            <br>
            <br>
            <center>
            <input type = "submit">
            </center>
            </form>
    </body>
</html>