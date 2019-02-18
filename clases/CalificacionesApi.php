<?php

require_once("Calificaciones.php");
include_once("../bd/AccesoDatos.php");
require 'autoload.php';



class CalificacionesApi
{

public function TraerPromedioCalificacion($request,$response,$args)
{

    $id = $args['id'];
    $promedioCalificacion = Calificaciones::TraerPromedioCalificacion($id);
    $resp["calificacion"]=$promedioCalificacion[0]->calificacion;
    return $response->withJson($resp);
}

}

?>