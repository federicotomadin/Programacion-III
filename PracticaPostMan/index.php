<?php

//include_once "IngresoDeDatos.php";


if(isset($_POST["guardar"])) 

{
 
$variable= $_POST["nombre"];

var_dump($variable);
}

else {
    $variable= $_POST["apellido"];
    var_dump($variable);
}



?>
