<?php

include_once "Persona.php";
include_once "Empleado.php";
include_once "Fabrica.php";


$empleado1=new Empleado("federico","tomadin","32191299","Masculino",655010,7000);
$empleado2=new Empleado("ramiro","cardeas","320354658","Masculino",777777,7000);

$fabrica1=new Fabrica("Srl");

$empleado1->ToString();
$empleado1->Hablar("Español");

$fabrica1->AgregarEmpleado($empleado1);
$fabrica1->AgregarEmpleado($empleado1);

//print_r($fabrica1->_Empleado);
//$fabrica1->EliminarEmpleado($empleado2);

$fabrica1->ToString();



?>