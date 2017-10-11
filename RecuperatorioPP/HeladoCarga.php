<?php

include "Helados.php";


$sabor=$_GET["sabor"];
$tipo= $_GET["tipo"];
$precio= $_GET["tipo"];
$cantidad= $_GET["cantidad"];

$helado=new Helado($sabor,$tipo,$precio,$cantidad);


Helado::AltaHelado($helado);


?>