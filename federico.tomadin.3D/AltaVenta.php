<?php

include "Clases/Usuario.php";
include "Clases/Helados.php";



Helado::AltaVenta($_POST["email"],$_POST["sabor"],$_POST["tipo"],$_POST["cantidad"]);



?>