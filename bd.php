<?php
    $db = mysqli_connect("localhost", "sigacitc_sgcitcg", "Calidad_1234","sigacitc_sgcitcg");
    // Check connection
    if ($db->connect_error) {
        die("¡Error al conectarse!: " . $db->connect_error);
    }
                $query= "UPDATE documentos SET nombre = 'Constancia de Exención de Examen Profesional' where codigo= 'Folio de constancia'";
	            if ($db->query($query) === TRUE) {
        	        echo "<script>
    	    	    alert('Archivo agregado exitosamente');
    	    	    window.top.location.href='documentacionAdmin.php';
    	 		    </script>";
        	    
	            }else {
            	    echo "Error al modificar el nombre." . $query . "<br>" . $db->error; 
        	    }
?>