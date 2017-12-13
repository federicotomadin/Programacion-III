<?php

require_once "BicicletaApi.php";
require_once "UsuarioApi.php";
require_once "AutentificadorJWT.php";

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
	public function Verificar($request, $response, $next) {
			
				$objDelaRespuesta= new stdclass();
				$objDelaRespuesta->respuesta="";
				$token="";				
			
		/*if($request->isGet())
		  {
			
				$response->getBody()->write('<p>NO necesita credenciales para los get </p>');
				return $response = $next($request, $response);
			
			
		 }*/
		/*  else
		  { 
			$ArrayDeParametros = $request->getParsedBody();
			$email=$ArrayDeParametros['email'];
			$clave=$ArrayDeParametros['clave'];
			$datos=array('email'=> $email,'clave'=> $clave);
					
			
			if((EmpleadoApi::VerificaEmpleado($email,$clave))=="Bienvenido")
			{			
				
				$response->getBody()->write($ArrayDeParametros['nombre'],$ArrayDeParametros['apellido'], $objDelaRespuesta->esValido=true);
				return $response;
			}*/
		

		
		
		 //tomo el token del header
		
				$arrayConToken = $request->getHeader('token');
				$token=$arrayConToken[0];	

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
		       

				if(isset($payload))
				{
				   
					$response->getBody()->write("color - ".$payload->color."<br>");
					$response->getBody()->write("rodado - ".$payload->rodado."<br>");
					 $response->getBody()->write("marca - ".$payload->marca);
					
					
				}

			}
				
		   else 
		   {
			$response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
			return $response;
		   }

		   return $response;
	
		
	}
}






