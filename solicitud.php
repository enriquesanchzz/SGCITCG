<?php
 include 'include/config.php';
if(isset($_POST['submit'])) {
    
   
    // Create connection
    $db = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    // Check connection
    if ($db->connect_error) {
        die("¡Error al conectarse!: " . $db->connect_error);
    }
    
    
    $mailTo = null;
    $depa = null;
    $responsable = null;
    
    //Informacion del destinatario
    $departamento = strip_tags($_POST['departamentos']);
    $subject ="Solicitud para el departamento de ".$departamento;
    
    //Informacion del remitente
    $area = strip_tags($_POST['areaRemitente']); // area que solicita
    $solicitante = strip_tags($_POST['solicitante']); // nombre del solicitante
    $mailFrom = strip_tags($_POST['email']); // correo de quien envia
    $fecha = date('d-m-Y H:i:s');; // fecha de envio
    $descripcion = strip_tags($_POST['descripcion']); // descripcion del problema

    
    $nameFile = $_FILES['archivo']['name'];
    $sizeFile = $_FILES['archivo']['size'];
    $typeFile = $_FILES['archivo']['type'];
    $tempFile = $_FILES['archivo']['tmp_name'];
    

    $sql = "SELECT * FROM departamentos where departamento ='".$departamento."'";
     if ($db->query($sql) == FALSE) {
         echo"<script type=\"text/javascript\">alert('No existe el departamento seleccionado');</script>";
        }
        else{
            $result = $db->query($sql);
            $numfilas = $result->num_rows;
            for ($x=0;$x<$numfilas;$x++) {
                $fila = $result->fetch_object();
                
                $depa = $fila->departamento;
                $responsable = $fila->responsable;
                $mailTo = $fila->email;
            }
        }
    $db->close();
        
    
    //multipart 
    $headers =  "MIME-VERSION: 1.0\r\n"; 
    $headers .= "Content-type: multipart/mixed;"; 
    $headers .= "boundary=\"=e=n=d=\"\r\n";
    $headers .= 'From: '.$mailFrom. "\r\n";
    
    //CORREO PARA LA DEPENDENCIA
    //primera parte del correo
    $cuerpo = "--=e=n=d=\r\n";
    $cuerpo .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //$cuerpo .= "charset=utf-8 \r\n"; 
    $cuerpo .= "Content-Transfer-Encoding: 8bit \r\n";
    $cuerpo .= "\r\n"; //linea vacía
    $cuerpo .= "Solicitud generada por: ".$solicitante."<br/>";
    $cuerpo .= "Correo Electronico: ".$mailFrom."<br/>";
    $cuerpo .= "Área del solicitante: ".$area."<br/>";
    $cuerpo .= "Enviado el: ".$fecha."<br/>";
    $cuerpo .= "Para:".$responsable." Responsable del departamento de".$depa."<br/>";
    $cuerpo .= "Detalles de la solicitud: \n ".$descripcion."<br/>";
    $cuerpo .= "\r\n"; //linea vacía
    
    if($tempFile != null){
    
    //Segunda Parte del correo
    $cuerpo .= "--=e=n=d=\r\n";
    $cuerpo .= "Content-Type: application/octet-stream;";
    $cuerpo .= "name=".$nameFile."\r\n";
    $cuerpo .= "Content-Transfer-Encoding: base64 \r\n";
    $cuerpo .= "Content-Disposition: attachment; ";
    $cuerpo .= "filename=".$nameFile."\r\n";
    $cuerpo .= "\r\n"; //linea vacía
    
    $fp = fopen($tempFile, "rb");
    $file = fread($fp, $sizeFile);
    $file = chunk_split(base64_encode($file));
    
    $cuerpo .= "$file \r\n";
    $cuerpo .= '\r\n'; //linea vacía
    $cuerpo .= '--=e=n=d=\r\n'; //delimitador del mensaje
    
    }
    
    //CORREO PARA EL SOLICITANTE
    //primera parte del correo
    $cuerpoSol = "--=e=n=d=\r\n";
    $cuerpoSol .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //$cuerpo .= "charset=utf-8 \r\n"; 
    $cuerpoSol .= "Content-Transfer-Encoding: 8bit \r\n";
    $cuerpoSol .= "\r\n"; //linea vacía
    $cuerpoSol .= "RESUMÉN DE SU SOLCITUD<br/>";
    $cuerpoSol .= "Solicitud generada por: ".$solicitante."<br/>";
    $cuerpoSol .= "Correo Electronico: ".$mailFrom."<br/>";
    $cuerpoSol .= "Área del solicitante: ".$area."<br/>";
    $cuerpoSol .= "Enviado a: ".$mailTo."<br/>";
    $cuerpoSol .= "Enviado el: ".$fecha."<br/>";
    $cuerpoSol .= "Para:".$responsable." Responsable del departamento de ".$depa."<br/>";
    $cuerpoSol .= "Detalles de la solicitud: \n ".$descripcion."<br/>";
    $cuerpoSol .= "\r\n"; //linea vacía
    $cuerpoSol .= "En breve recibira una respuesta del encargado de sección, ESTO ES UNA RESPUESTA AUTOMATICA, POR FAVOR,NO CONTESTE A ESTE MENSAJE";
    
    
    

    
    
    if(mail($mailTo, $subject, $cuerpo, $headers)){
        echo '<script type="text/javascript"> alert("Gracias por contactarnos, Recibiras una respuesta en tu correo en las proximas 24 horas");
        window.location.href="FormSolicitud.php";
        </script>';
        mail($mailFrom, $subject, $cuerpoSol, $headers);
    } else {
        echo '<script type="text/javascript"> alert("Lo sentimos, tu solicitud no pudo ser procesada, intentalo de nuevo");
        window.location.href="FormSolicitud.php";
        </script>';
    }
   
    
}
?>