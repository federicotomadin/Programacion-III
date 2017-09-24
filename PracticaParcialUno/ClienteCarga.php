<?php

include_once "clientes.php";


$cliente1= new Cliente($_GET['nombre'],$_GET['mail'],$_GET['clave'],$_GET['sexo']);

//Cliente::Guardar($cliente1);

Cliente::Validar($cliente1);


?>