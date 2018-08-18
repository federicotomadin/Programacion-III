<?php
require_once("Sesion.php");
include_once("../bd/AccesoDatos.php");
require 'autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class SesionApi
{

public function TraerTodasLasSesiones($request,$response,$args)
{

$sesiones= Sesion::TraerTodasLasSesiones();
if($sesiones==null)
{
    $resp["status"]=400;
}
else 
{
    $resp["status"]=200;
    $resp["sesiones"]=$sesiones;
}

return $response->withJson($resp);

}

}

?>