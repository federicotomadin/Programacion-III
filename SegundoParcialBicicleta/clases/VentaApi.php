<?php

include_once "venta.php";


class VentaApi extends Venta
{


    public function AltaVenta($request, $response, $args) {

    $ArrayDeParametros = $request->getParsedBody();

    $archivos = $request->getUploadedFiles();
    $destino="./FotosVentas/";
    $nombreAnterior=$archivos['foto']->getClientFilename();
    $extension= explode(".", $nombreAnterior);
    $extension=array_reverse($extension);

  $ahora=date("Ymd");
  $miVenta = new Venta();
  $miVenta->fecha=$ahora;
  $miVenta->nombreCliente=$ArrayDeParametros['nombreCliente']; 
  $miVenta->precio=$ArrayDeParametros['precio'];
  $miVenta->idBicicleta=$ArrayDeParametros['idBicicleta'];

  $id=Venta::InsertarLaVentaParametros($miVenta);


  $archivos['foto']->moveTo($destino.$id.$miVenta->nombreCliente.".".$extension[0]);
  $response->getBody()->write("se guardo la venta de la bicicleta");

  return $response;

    }

}