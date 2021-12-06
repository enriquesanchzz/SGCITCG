<?php
             include 'include/config.php';
            // Check connection
            $db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    // Check connection
    if ($db->connect_error) {
        die("¡Error al conectarse!: " . $db->connect_error);
        }

                $sql="SELECT  `responsable`, `ubicacion`, `email`, `extension` FROM `departamentos` where `departamento`='Energia'";
                if ($db->query($sql) == FALSE) {
                echo"<script type=\"text/javascript\">alert('No existe registro con ese nombre'); window.location='modificarContacto.html';</script>";
                }
                else{
                $result = $db->query($sql);
                $numfilas = $result->num_rows;

                echo "<center>";
                for ($x=0;$x<$numfilas;$x++) {
                $fila = $result->fetch_object();
                    

                //echo "<td>".$fila->nombre."</td>";
                echo "<label for = \"Responsable\"> $fila->responsable </label>";
                echo "<br/>";
                //echo "<td>".$fila->correo."</td>";
                echo "<label for = \"Extension\">Oficina: $fila->ubicacion </label>";
                echo "<br/>";
                //echo "<td>".$fila->tel."</td>";
                echo "<label for = \"Email\">Email: $fila->email </label>";
                echo "<br/>";
                //echo "<td>".$fila->movil."</td>";
                echo "<label for = \"Ubicacion\">Extension: $fila->extension </label>";

                }
                echo "</center>";
                }
                //$db->close();
                $db->close();
            ?>
