<?php

//include_once "IngresoDeDatos.php";


$alta = isset($_POST["guardar"]) ? TRUE : FALSE;
if($alta)
{
 
$variable= $_POST["nombre"];

var_dump($variable);
}



?>
