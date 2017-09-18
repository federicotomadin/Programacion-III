<?php

include "Operario.php";
include "Fabrica.php";


$operario1=new Operario(1,"tomadin","federico");
$operario2=new Operario(2,"sanabria","ignacio",2000);
$operario3=new Operario(3,"galvan","celeste",21000);
$operario4=new Operario(4,"torres","matias",22000);


$fabrica=new Fabrica("Colmena");

$fabrica->Add($operario1);
$fabrica->Add($operario2);
$fabrica->Add($operario3);
$fabrica->Add($operario4);

Fabrica::MostrarCostos($fabrica);
$fabrica->Remove($operario1);

var_dump($fabrica);


?>