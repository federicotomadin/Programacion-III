<?php

$lapicera['color']="rojo";
$lapicera['marca']="pen";
$lapicera['trazo']="grueso";
$lapicera['precio']="20";

$lapicera['color']="verde";
$lapicera['marca']="parker";
$lapicera['trazo']="medio";
$lapicera['precio']="30";

$lapicera['color']="azul";
$lapicera['marca']="parker";
$lapicera['trazo']="fino";
$lapicera['precio']="50";


foreach($lapicera as $clave=>$valor)
{
     echo "Clave: $clave; Valor: $valor<br>";
}


?>
