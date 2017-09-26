<?php

include_once "Usuario.php";

$mail=$_POST['mail'];
$titulo=$_POST['titulo'];
$comentario=$_POST['comentario'];


Usuario::AltaComent($mail,$titulo,$comentario);



?>