<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'composer/vendor/autoload.php';
require 'clases/AccesoDatos.php';
require 'clases/HeladoApi.php';
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


$app->get('/crearToken/', function (Request $request, Response $response) {
 //$datos = array('usuario' => 'rogelio@agua.com','perfil' => 'profe', 'alias' => "PinkBoy");
$token="";
$ArrayDeParametros = $request->getParams('email','clave','perfil');
 $email=$ArrayDeParametros['email'];
 	$clave=$ArrayDeParametros['clave'];
 	$perfil=$ArrayDeParametros['perfil'];
   $datos=array('email'=> $email,'clave'=> $clave,'perfil'=>$perfil);
   
    if(usuarioApi::Validar($email,$clave)=="Bienvenido")
				{			
        				
				
				 	 $token= AutentificadorJWT::CrearToken($datos);
            $newResponse = $response->withJson($token, 200); 
        }
        
        else
        {
          $respuesta=(usuarioApi::Validar($email,$clave));
          $newResponse = $response->withJson($respuesta, 200); 
        }
 
  return $newResponse;
});


/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/Helado', function () {
 
  $this->get('/', \HeladoApi::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
 
  $this->get('/{id}', \HeladoApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

  $this->post('/', \HeladoApi::class . ':CargarUno');

  $this->delete('/', \HeladoApi::class . ':BorrarUno');

  $this->put('/', \HeladoApi::class . ':ModificarUno');
     
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->run();