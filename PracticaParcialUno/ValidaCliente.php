<?php

include_once "clientes.php";

$verificar = isset($_POST['verificar'])? TRUE : FALSE;
if($verificar)
  {
 
    if(!Cliente::Validar($_POST['nombre'],$_POST['clave']))
    {
      echo "ERROR EL CORREO Y/O CLAVE NO ESTAN INGRESADOS EN EL ARCHIVO";
    }
    else
    {
        echo "CORERO = OK CLAVE = OK";
      //  header("location:Listado.php");
    }
}

else{
    echo "NO SE PUEDE VERIFICAR";
}

    ?>