<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'composer/vendor/autoload.php';
require 'clases/AccesoDatos.php';
require 'clases/EmpleadoApi.php';
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

$app->post('/crearToken/', function (Request $request, Response $response) {
$token="";
//$ArrayDeParametros = $request->getParams('email','clave');
$ArrayDeParametros = $request->getParsedBody();
 $email=$ArrayDeParametros['email'];
   $clave=$ArrayDeParametros['clave'];
   $perfil=$ArrayDeParametros['perfil'];
   $datos=array('email'=> $email,'clave'=> $clave,'perfil'=> $perfil);
   
    if(EmpleadoApi::VerificaEmpleado($email,$clave,$perfil)=="Bienvenido" )
				{			
           
				
             $token= AutentificadorJWT::CrearToken($datos);
             $response->getBody()->write($token);
        
        }
        
        else
        {
        
          $response->getBody()->write("Los datos ingresados no son validos");
        }
       
 
}); 


/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/

$app->group('/Empleado', function () {

  $this->get('/', \EmpleadoApi::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
 
  $this->get('/{id}', \EmpleadoApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  $this->post('/', \EmpleadoApi::class . ':CargarUno');

  $this->delete('/', \EmpleadoApi::class . ':BorrarUno');

  $this->put('/', \EmpleadoApi::class . ':ModificarUno');
     
})->add(\MWparaAutentificar::class . ':Verificar')->add(\MWparaCORS::class . ':HabilitarCORS8080');

//$app->run();

$app->add($contador);
$app->group('/Producto', function () {
  

    $this->get('/', \ProductoApi::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   
    $this->get('/{id}', \ProductoApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
    
    $this->post('/', \ProductoApi::class . ':CargarUno');
  
    $this->delete('/', \ProductoApi::class . ':BorrarUno');
  
    $this->put('/', \ProductoApi::class . ':ModificarUno');
       
  })->add(\MWparaAutentificar::class . ':Verificar')->add(\MWparaCORS::class . ':HabilitarCORS8080');
  
  $app->run();
  

