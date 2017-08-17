<?php

$lapicera1['color']="rojo";
$lapicera1['marca']="pen";
$lapicera1['trazo']="grueso";
$lapicera1['precio']="20";

$lapicera2['color']="verde";
$lapicera2['marca']="parker";
$lapicera2['trazo']="medio";
$lapicera2['precio']="30";


$lapicera3['color']="azul";
$lapicera3['marca']="parker";
$lapicera3['trazo']="fino";
$lapicera3['precio']="50";

$array=array("lapicera1","lapicera2","lapicera3");

$array2=array($lapicera1,$lapicera2,$lapicera3);


foreach($array as $valor)
{
   // echo "Clave: $clave; Valor: $valor<br>";

    echo  "$valor<br>";
}


foreach($array2 as $valor)
{
    echo "<br/n>";
    foreach($valor as $valor1)
    {
  
    echo  "$valor1<br>";
    }
   
}


?>
