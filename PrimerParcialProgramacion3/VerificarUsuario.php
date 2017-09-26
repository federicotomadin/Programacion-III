
<?php

include_once "Usuario.php";

if(Usuario::VerificarUsuario($_POST['mail'],$_POST['clave']))
{
   echo "bienvenido";
} 
else {
    echo "Los datos estan mal ingresados";
}


?>