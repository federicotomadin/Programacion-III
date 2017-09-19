<?php
require("Clases/conteiner.php");
if(isset($_GET['numero']))
{
$codigo = $_GET['numero'];
if(Conteiner::BorrarElConteiner($codigo))
{
    
    header("location:Grilla.php");
}
else
 {
    echo "No se pudo borrar el conteiner";
}
}