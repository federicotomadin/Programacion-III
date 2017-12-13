<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'composer/vendor/autoload.php';
require "clases/usuario.php";
require "clases/UsuarioApi.php";
require "clases/bicicletaApi.php";
require "clases/VentaApi.php";
require "clases/AutentificadorJWT.php";
require "clases/MWparaAutentificar.php";
require "clases/MWparaCORS.php";

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);
// $app->get('/hello/{name}', function (Request $request, Response $response) {
//     $name = $request->getAttribute('name');
//     $response->getBody()->write("Hello, $name");

//     return $response;
// });

$app->post('/VerificarId/', function (Request $request, Response $response) {
   $resp["respuesta"] = "ESTA INGRESANDO MAL EL USUARIO";


   $data = $request->getParsedBody();
   $id= $data["id"];

   if(Bicicleta::VerificarId($id))
   {
  
   
    $info= Bicicleta::TraerLaBicicletaPorId($id);

  
    $token= AutentificadorJWT::CrearToken($info);
    $response->getBody()->write($token);

  }

else
{

 $response->getBody()->write("Los datos ingresados no son validos");
}

});


$app->group('/Bicicleta', function () {
    
  
      $this->get('/', \BicicletaApi::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
     
      $this->get('/{id}', \BicicletaApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

      $this->get('BuscarPorColor/{color}', \BicicletaApi::class . ':traerTodosPorColor');
      
      $this->post('/', \BicicletaApi::class . ':CargarUno');

      $this->delete('/', \BicicletaApi::class . ':BorrarUno');
    
      $this->put('/', \BicicletaApi::class . ':ModificarUno');
         
    })->add(\MWparaAutentificar::class . ':Verificar')->add(\MWparaCORS::class . ':HabilitarCORS8080');
    
    $app->run();

    $app->group('/VentaBicicleta', function () {
        
      
        $this->post('/', \VentaApi::class . ':AltaVenta');
        
             
        });//->add(\MWparaAutentificar::class . ':Verificar')->add(\MWparaCORS::class . ':HabilitarCORS8080');
        
     


?>