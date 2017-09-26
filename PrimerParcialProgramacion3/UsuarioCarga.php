<?php

include_once "Usuario.php";


$usuario1=new Usuario($_GET['nombre'],$_GET['mail'],$_GET['edad'],$_GET['perfil'],$_GET['clave']);


Usuario::Guardar($usuario1);














?>