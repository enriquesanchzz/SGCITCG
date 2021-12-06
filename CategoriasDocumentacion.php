<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleEstandares.css">
    </head>
        <body>
          <!--Seccion con los iconos de los estandares-->
          <section>
            <!--Primer columna de 3-->
            <form action="vistaCategoriasDoc.php" name="selectCat" method="POST">
            <div class="row">
                <div class="column">
                    <button type="submit" name="std" value="docSGC"><img id="std" src="img/GESTION-DE-CALIDAD.png"></button>
                    <h4>Documentación Sistema de Gestión de la Calidad</h4>
                </div>
                <div class="column">
                    <button type="submit" name="std" value="docCalidad"><img id="std" src="img/GESTION-DE-CALIDAD.png"></button>
                    <h4>Documentación interna Calidad</h4>
                </div>
                <div class="column">
                    <button type="submit" name="std" value="docAmbiental"><img id="std" src="img/14001.png"></button>
                    <h4>Documentación interna Ambiental</h4>
                </div>
                
            </div>
                <!--Segunda columna de 3-->
               <div class="row">
                   <div class="column">
                        <button type="submit" name="std" value="docEnergia"><img id="std" src="img/GESTION-DE-LA-ENERGIA.png"></button>
                        <h4>Documentación interna Energía</h4>
                    </div>
                    <div class="column">
                        <button type="submit" name="std" value="docOrganizacional"><img id="std" src="img/logo%20itcg.png"></button>
                        <h4>Documentación de Conocimiento Organizacional</h4>
                    </div>
                    <div class="column">
                        <button type="submit" name="std" value="docIgualdad"><img id="std" src="img/no%20discriminacion%20logo.png"></button>
                        <h4>Documentación interna Igualdad y no Discriminacion</h4>
                    </div>
                </div>

                    <!--Tercera columna de 3-->
               <div class="row">
                   <div class="column">
                        <input type="hidden" name="documentacion" value="Documentación interna Salud y Seguridad">
                        <button type="submit" name="std" value="docSalud"><img id="std" src="img/logo%2045001.png"></button>
                        <h4>Documentación interna Salud y Seguridad</h4>
                    </div>
                    <div class="column">
                        <input type="hidden" name="documentacion" value="Documentación interna Responsabilidad Social">
                        <button type="submit" name="std" value="docSocial"><img id="std" src="img/onu.png"></button>
                        <h4>Documentación interna Responsabilidad Social</h4>
                    </div>
                </div>
            </form>
        </section>
        
        </div>
        </body>
</html>
