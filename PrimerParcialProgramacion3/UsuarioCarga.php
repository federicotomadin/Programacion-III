<?php

include_once "Usuario.php";


$usuario1=new Usuario($_GET['nombre'],$_GET['mail'],$_GET['edad'],$_GET['clave'],$_GET['perfil']);


Usuario::Guardar($usuario1);














?>