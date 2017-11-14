<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'composer/vendor/autoload.php';
require 'clases/AccesoDatos.php';
require 'clases/EmpleaApi.php';
require 'clases/ProductoApi.php';
require 'clases/MWparaCORS.php';
require 'clases/MWparaAutentificar.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);


/*$app->get('/crearToken/', function (Request $request, Response $response) {
$token="";
$ArrayDeParametros = $request->getParams('email','clave');
 $email=$ArrayDeParametros['email'];
 	$clave=$ArrayDeParametros['clave'];
   $datos=array('email'=> $email,'clave'=> $clave);
   
    if(EmpleadoApi::VerificarUsuario($email,$clave)=="Bienvenido")
				{			
        				
				
				 	 $token= AutentificadorJWT::CrearToken($datos);
            $newResponse = $response->withJson($token, 200); 
        }
        
        else
        {
          $respuesta=(EmpleadoApi::VerificarUsuario($email,$clave));
          $newResponse = $response->withJson($respuesta, 200); 
        }
 
  return $newResponse;
});


/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/Empleado', function () {

  $this->get('/', \EmpleaApi::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
 
  $this->get('/{id}', \EmpleaApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

  $this->post('/', \EmpleaApi::class . ':CargarUno');

  $this->delete('/', \EmpleaApi::class . ':BorrarUno');

  $this->put('/', \EmpleaApi::class . ':ModificarUno');
     
})->add(\MWparaAutentificar::class . ':Verificar')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->run();


$app->group('/Producto', function () {
  
   $this->get('/', \ProductoApì::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
   $this->get('/{id}', \ProductoApì::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
 
   $this->post('/', \ProductoApì::class . ':CargarUno');
 
   $this->delete('/', \ProductoApì::class . ':BorrarUno');
 
   $this->put('/', \ProductoApì::class . ':ModificarUno');
      
 })->add(\MWparaAutentificar::class . ':VerificaEmpleado')->add(\MWparaCORS::class . ':HabilitarCORS8080');
 
 $app->run();