<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require "clases/usuario.php";
require "clases/UsuarioApi.php";
require "clases/bicicletaApi.php";
require "clases/VentaApi.php";

$app = new \Slim\App;
// $app->get('/hello/{name}', function (Request $request, Response $response) {
//     $name = $request->getAttribute('name');
//     $response->getBody()->write("Hello, $name");

//     return $response;
// });

$app->post('/VerificarUsuario/', function (Request $request, Response $response) {
   $resp["respuesta"] = "ESTA INGRESANDO MAL EL USUARIO";
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


$app->group('/Bicicleta', function () {
    
  
      $this->get('/', \BicicletaApi::class . ':traerTodos');//->add(\MWparaCORS::class . ':HabilitarCORSTodos');
     
      $this->get('/{id}', \BicicletaApi::class . ':traerUno');//->add(\MWparaCORS::class . ':HabilitarCORSTodos');

    //  $this->get('/{color}', \BicicletaApi::class . ':traerTodosPorColor');
      
      $this->post('/', \BicicletaApi::class . ':CargarUno');

    
      $this->delete('/', \BicicletaApi::class . ':BorrarUno');
    
      $this->put('/', \BicicletaApi::class . ':ModificarUno');
         
    });//->add(\MWparaAutentificar::class . ':Verificar')->add(\MWparaCORS::class . ':HabilitarCORS8080');
    

    $app->group('/VentaBicicleta', function () {
        
      
        $this->post('/', \VentaApi::class . ':AltaVenta');
        
             
        });//->add(\MWparaAutentificar::class . ':Verificar')->add(\MWparaCORS::class . ':HabilitarCORS8080');
        
        $app->run();


?>