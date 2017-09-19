<?php


$insertarConteiner = isset($_POST['agregarConteiner']) ? TRUE : FALSE;
if($insertarConteiner)
{
    //INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO
$destino = "imagen/" . $_FILES["archivo"]["name"];

$uploadOk = TRUE;

	$tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);



}


?>