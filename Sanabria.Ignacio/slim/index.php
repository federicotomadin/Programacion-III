<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
include_once("../clases/usuario.php");
include_once("../clases/bicicleta.php");
include_once("../clases/venta.php");

$app = new \Slim\App;
// $app->get('/hello/{name}', function (Request $request, Response $response) {
//     $name = $request->getAttribute('name');
//     $response->getBody()->write("Hello, $name");

//     return $response;
// });

$app->post('/VerificarUsuario', function (Request $request, Response $response) {
   $resp["respuesta"] = "ERROR";
   $data = $request->getParsedBody();
   $usuario = Usuario::TraerElUsuarioPorNombre($data["nombre"]);
   if(Usuario::VerificarElUsuario($data["mail"],$data["nombre"],$data["clave"]))
   {
       $resp["respuesta"] = "OK";
       $resp["perfil"] = $usuario->perfil;
       $resp = $usuario;
   }
   return $response->withJson($resp);
});


$app->post('/InsertarNuevaBicicleta',function (Request $request, Response $response) {
  $data = $request->getParsedBody();
  $resp["status"] = 200;
  $resp["respuesta"] = "la bicicleta se inserto correctamente";
  $bici = new Bicicleta();
  $bici->SetColor($data["color"]);
  $bici->SetRodado($data["rodado"]);
  $bici->SetMarca($data["marca"]);
  if(!Bicicleta::InsertarLaBicicletaParametros($bici))
  {
      $resp["status"] = 400;
  }
   return $response->withJson($resp);
});

$app->get('/TraerTodasLasBicicletas',function (Request $request, Response $response) {
    $bicicletas = Bicicleta::TraerTodasLasBicicletas();
    $response= $response->withJson($bicicletas);
    return $response;
});

$app->get('/TraerTodasLasBicicletas/{color}',function (Request $request, Response $response) {
    $color = $request->getAttribute('color');
    $bicicletas = Bicicleta::TraerTodasLasBicicletasPorColor($color);
    $response= $response->withJson($bicicletas);
    return $response;
});

$app->get('/TraerBicicleta/{id}', function (Request $request, Response $response) {
     $id = $request->getAttribute('id');
     $bicicleta = Bicicleta::TraerLaBicicletaPorId($id);
     $response= $response->withJson($bicicleta);
     return $response;
});

//Inserte Una Bici random en el id 5 y la deletee
$app->delete('/BorrarBicicleta/{id}', function (Request $request, Response $response) {
   $id = $request->getAttribute('id');
   $resp["status"] = 200;
   if(!Bicicleta::BorrarLaBicicleta($id))
   {
       $resp["status"] = 400;
   }
   return $response->withJson($resp);
});


$app->post('/InsertarNuevaVenta', function (Request $request, Response $response) {
    $destino = "../FotosVentas/";
    $data = $request->getParsedBody();
    $files = $request->getUploadedFiles();
    if(Bicicleta::VerificarId($data["idBicicleta"]))
    {
    $nombreAnterior=$files['foto']->getClientFilename();
	$extension= explode(".", $nombreAnterior) ;
	$extension=array_reverse($extension);
    $files['foto']->moveTo($destino.$data["idBicicleta"].$data["nombrecliente"].".".$extension[0]);
    $resp["status"] = 200;
    $venta = new Venta();
    $venta->nombrecliente =  $data["nombrecliente"];
    $venta->fecha = $data["fecha"];
    $venta->idBicicleta = $data["idBicicleta"];
    $venta->precio = $data["precio"];
    if(!Venta::InsertarLaVentaParametros($venta))
    {
        $resp["status"] = 400;
    }
    }
    else
    {
        $resp["status"] = "ERROR. EL ID NO EXISTE";
    }
    return $response->withJson($resp);
});


$app->run();
?>