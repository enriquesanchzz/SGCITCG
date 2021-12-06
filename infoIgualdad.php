<?php
              include 'include/config.php';
              $db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
              // Check connection
              if ($db->connect_error) {
                  die("¡Error al conectarse!: " . $db->connect_error);
                  }

                $sql="SELECT  `responsable`, `ubicacion`, `email`, `extension` FROM `departamentos` where `departamento`='Presidente Igualdad'";
                if ($db->query($sql) == FALSE) {
                echo"<script type=\"text/javascript\">alert('No existe registro con ese nombre');</script>";
                }
                else{
                echo "<h8>Propietarios:</h8>";
                echo"</br>";
                $result = $db->query($sql);
                $numfilas = $result->num_rows;
                for ($x=0;$x<$numfilas;$x++) {
                $fila = $result->fetch_object();
                //echo "<td>".$fila->nombre."</td>";
                echo "<h9><label for = \"Responsable:\">Presidente: $fila->Responsable </label></h9>";
                echo"</br>";
                }
                }

                $sql="SELECT  `responsable`, `ubicacion`, `email`, `extension` FROM `departamentos` where `departamento`='Secretaria Ejecutiva Igualdad'";
                if ($db->query($sql) == FALSE) {
                echo"<script type=\"text/javascript\">alert('No existe registro con ese nombre');</script>";
                }
                else{
                $result = $db->query($sql);
                $numfilas = $result->num_rows;
                for ($x=0;$x<$numfilas;$x++) {
                $fila = $result->fetch_object();
                //echo "<td>".$fila->nombre."</td>";
                echo "<h9><label for = \"Responsable:\">Secretario Ejecutivo: $fila->Responsable </label></h9>";
                echo"</br>";
                echo"</br>";
                }
                }

                
                $sql="SELECT  `responsable`, `ubicacion`, `email`, `extension` FROM `rdepartamentos where `departamento='Suplente Presidente Igualdad'";
                if ($db->query($sql) == FALSE) {
                echo"<script type=\"text/javascript\">alert('No existe registro con ese nombre');</script>";
                }
                else{
                echo "<h8>Suplentes:</h8>";
                echo"</br>";
                $result = $db->query($sql);
                $numfilas = $result->num_rows;
                for ($x=0;$x<$numfilas;$x++) {
                $fila = $result->fetch_object();
                //echo "<td>".$fila->nombre."</td>";
                echo "<h9><label for = \"Responsable:\">Presidente: $fila->Responsable </label></h9>";
                echo"</br>";
                }
                }

                $sql="SELECT  `responsable`, `ubicacion`, `email`, `extension` FROM `rdepartamentos where `departamento='Suplente Secretaria Ejecutiva Igualdad'";
                if ($db->query($sql) == FALSE) {
                echo"<script type=\"text/javascript\">alert('No existe registro con ese nombre');</script>";
                }
                else{
                $result = $db->query($sql);
                $numfilas = $result->num_rows;
                for ($x=0;$x<$numfilas;$x++) {
                $fila = $result->fetch_object();
                //echo "<td>".$fila->nombre."</td>";
                echo "<h9><label for = \"Responsable:\">Secretario Ejecutivo:  $fila->Responsable </label></h9>";
                //$db->close();
                $db->close();
                }
            }
            ?>
