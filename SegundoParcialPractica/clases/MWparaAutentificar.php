<?php

include "usuarioApi.php";
include "AutentificadorJWT.php";

class MWparaAutentificar
{
 /**
   * @api {any} /MWparaAutenticar/  Verificar Usuario
   * @apiVersion 0.1.0
   * @apiName VerificarUsuario
   * @apiGroup MIDDLEWARE
   * @apiDescription  Por medio de este MiddleWare verifico las credeciales antes de ingresar al correspondiente metodo 
   *
   * @apiParam {ServerRequestInterface} request  El objeto REQUEST.
 * @apiParam {ResponseInterface} response El objeto RESPONSE.
 * @apiParam {Callable} next  The next middleware callable.
   *
   * @apiExample Como usarlo:
   *    ->add(\MWparaAutenticar::class . ':VerificarUsuario')
   */
	public function VerificarUsuario($request, $response, $next) {
			

				$objDelaRespuesta= new stdclass();
				$objDelaRespuesta->respuesta="";
				

		if($request->isGet())
		  {
		
				$response->getBody()->write('<p>NO necesita credenciales para los get </p>');
		    return 	$response = $next($request, $response);
		
		 }
		  else
		  {
				   
		    //$ArrayDeParametros = $request->getParsedBody();
		  //  $email=$ArrayDeParametros['email'];
			//	$clave=$ArrayDeParametros['clave'];
			//	$perfil=$ArrayDeParametros['perfil'];
			//	$datos=array('email'=> $email,'clave'=> $clave,'perfil'=>$perfil);
					
				//if(usuarioApi::Validar($email,$clave))
				//{								
				
				// 	 $token= AutentificadorJWT::CrearToken($datos);
					
				//}

		

			
		 //tomo el token del header
			
				$arrayConToken = $request->getHeader('token');
				$token=$arrayConToken[0];			
			
			//	var_dump($token);
			//	die();
		//	$objDelaRespuesta->esValido=true; 

			try 
			{
				//$token="";
				AutentificadorJWT::verificarToken($token);
				$objDelaRespuesta->esValido=true;   
			 
			}
			catch (Exception $e) {      
				//guardar en un log
				$objDelaRespuesta->excepcion=$e->getMessage();
				$objDelaRespuesta->esValido=false;     
			}


			if($objDelaRespuesta->esValido)
			{		
				$payload=AutentificadorJWT::ObtenerData($token);

			
				if($payload->perfil=='usuario')
				{				
				
					if($request->isPost()) 
				{		
						    
				   return 	$response = $next($request, $response);
				}
				else 
				{
					$response->getBody()->write('<h1>no tenes permiso para ejecutar esta opcion</h1>');
					return $response;   
				}
			}

			elseif($payload->perfil=='administrador')
			{
				//var_dump($payload);
					// DELETE,PUT y DELETE sirve para todos los logeados y admin
			return	$response=$next($request,$response);
			}
		
		}
		else
		{
			 $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
			return $response;
		

		}  
		  
		  $response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
		  return $response;   
	}
}

}

