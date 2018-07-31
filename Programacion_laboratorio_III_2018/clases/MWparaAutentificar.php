<?php

include_once "AutentificadorJWT.php";
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
		// $response->getBody()->write('<p>NO necesita credenciales para los get </p>');
		 $response = $next($request, $response);
		}
		else
		{
	
		$arrayConToken = $request->getHeader('token');
		$token=$arrayConToken[0];
			
			try 
			{
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
			

				if($request->isPost())
				{		
					// el post sirve para todos los logueados		
					$payload=AutentificadorJWT::ObtenerData($token);		    
					$response = $next($request, $response);
				}
				else 
				{
					$payload=AutentificadorJWT::ObtenerData($token);
					// DELETE,PUT y DELETE sirve para todos los logeados y admin
					if($payload->perfil=="Socio")
					{
						//var_dump($payload);
					 // die();
						$response = $next($request, $response);
					}		           	
					else
					{	
						$objDelaRespuesta->respuesta="Solo socios";
					}
				}		          
			}    
			else
			{
				$objDelaRespuesta->respuesta="Solo usuarios registrados";
				$objDelaRespuesta->elToken=$token;
			}  
		}		  
		if($objDelaRespuesta->respuesta!="")
		{
			return $response->withJson($objDelaRespuesta, 401);  			
		}  
		 return $response;   
	}
}