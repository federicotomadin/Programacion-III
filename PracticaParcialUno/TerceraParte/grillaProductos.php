<?php

/*   
griilla productos
retorna una tabla de productos con la imagen correspondiente de cada productos

*/

include_once "producto.php";

$archivo = fopen('Archivos/Productos.txt',"r");

echo '<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="stylesheet" href="CSS/estilo.css">
</head><html><body><h3>Administración de cuadrilla</h3>';

while(!feof($archivo))
{
    $aux = fgets($archivo);
    $cadena = explode("Imagen: ",$aux);
    if($cadena[0] == "")continue; 
    echo '<div id = "central"><img src= '.$cadena[1].' alt="Smiley face" height="200" width="200"><br><h5>'.$cadena[0].'</h5><br></div>';
}
echo '</body></html>';
fclose($archivo);  

?>