<?php

include "Helados.php";


$helado=new Helado($_GET["sabor"],$_GET["tipo"],$_GET["precio"],$_GET["cantidad"]);


Helado::AltaHelado($helado);


?>