<html>
<body>
<?php

include("Persona.php");
include("Empleado.php");


$archivo = fopen('Archivos/EmpleadosImagen.txt',"r");       
while(!feof($archivo))
{   
    $aux = fgets($archivo);
    $cadena = explode("Imagen: ",$aux);
    if($cadena[0] == "")break;  
    echo '<img src= '.$cadena[1].' alt="Smiley face" height="300" width="300"><br><h5>'.$cadena[0].'</h5><br>';     
}
fclose($archivo);  


?>
</body>
             </html>