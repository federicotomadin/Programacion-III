<?php
require_once("Mesas.php");
require_once("Cliente.php");
include_once("../bd/AccesoDatos.php");
require 'autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

class MesasApi
{

public function CambiarEstadoMesaOcupada($request,$response,$args)
{
    $IdMesa = $args['IdMesa'];

    $resp["status"] = 200;
    if (!Mesas::CambiarEstadoMesaOcupada($IdMesa))
    {
         $resp["status"] = 400;
    }

    return $response->withJson($resp);
}


public function CambiarEstadoMesaEsperandoAtencion($request,$response,$args)
{
    $IdMesa = $args['id'];
    $data = $request->getParsedBody();
    

    $resp["status"] = 400;
    if (Mesas::CambiarEstadoMesaEsperandoAtencion($IdMesa))
    {
        Cliente::ActualizarCodigoMesaEnElCliente($IdMesa,$data["usuario"]);
         $resp["status"] = 200;
    }

    return $response->withJson($resp);
}

public function CambiarEstadoMesaLibre($request,$response,$args)
{
    $IdMesa = $args['IdMesa'];

    $resp["status"] = 200;
    if (!Mesas::CambiarEstadoMesaLibre($IdMesa))
    {
         $resp["status"] = 400;
    }

    return $response->withJson($resp);
}

public function TraerLasMesasEsperandoAtencion($request,$response,$args)
{

    $mesas = Mesas::TraerLasMesasEsperandoAtencion();
    $resp["mesas"] = $mesas;
    return $response->withJson($resp);
}

public function TraerLasMesasEsperandoPedido($request,$response,$args)
{
    $mesas = Mesas::TraerLasMesasEsperandoPedido();
    $resp["mesas"] = $mesas;
    return $response->withJson($resp);
}

public function TraerLasMesasOcupadas($request,$response,$args)
{

    $mesas = Mesas::TraerLasMesasOcupadas();
    $resp["mesas"] = $mesas;
    return $response->withJson($resp);
}

public function TraerTodasLasMesas($request,$response,$args)
{
    $mesas = Mesas::TraerTodasLasMesas();
    $resp["mesas"] = $mesas;
    return $response->withJson($resp);
}



}

?>