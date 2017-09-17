<html>
<body>
<?php

include("Persona.php");
include("Empleado.php");

$miarray = array();
$arrayPath = array();

$gestor = fopen("empleados.txt","r");

while(!feof($gestor))
{
 if(($lector = fgets($gestor)) != false)
 {
     $miarray = explode("_",$lector);
     for($i=0;$i<count($miarray);$i++)
     {
         if($miarray[$i] != $miarray[6])
         {
          echo $miarray[$i]."_";
         }
         //Comentarle al profe que el explode rompe el nombre de la foto
         //fotos/dni-apellido.extension
         //Comentarle que cambie el guion por el guion bajo
         else if($miarray[$i] == $miarray[6])
         {
             echo "<br>";
             $imagen = $miarray[$i];
             echo "<img src = $imagen>";
         }
     }
     echo"<br>";
 }
}

?>
</body>
             </html>