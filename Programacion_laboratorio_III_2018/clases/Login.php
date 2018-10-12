<?php
include_once("Empleado.php");
include_once("Roles.php");
include_once("Sesion.php");
include_once("AutentificadorJWT.php");
class Login
{
 
public function ValidarUsuario($request, $response, $args) {
 
   $datos = $request->getParsedBody();
   
    if(Empleado::VerificarEmpleado($datos['Usuario'],$datos['Clave']))
      {
     
       $empleado = Empleado::TraerElEmpleadoPorUsuario($datos['Usuario']);
       if($empleado->habilitado == 1)
       {
       $resp["status"] = 200;
       $roles = Roles::TraerRoles();
       $resp["id"] = $empleado->Getid_empleado();
       foreach($roles as $rolEmpleado)
       { 
           if($rolEmpleado->Id_rol == $empleado->Id_rol)
           { 
               $resp["tipo"] = $rolEmpleado->descripcion;            
               break;
           }
       }
       $sesion = new Sesion();
       $sesion->SetIdEmpleado($empleado->id_empleado);
       $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
       $fecha_ingreso = $dateTime->format("m/d/Y g:i A");
       $resp["hora"]=$fecha_ingreso;
       $sesion->SetFechaIngreso($fecha_ingreso);
       Sesion::InsertarSesionInicio($sesion);
       $resp["Usuario"]=$datos['Usuario'];
       $datosToken = array('Usuario' => $datos['Usuario'],'perfil' => $resp["tipo"]);
       $token = AutentificadorJWT::CrearToken($datosToken);
       $resp["token"] = $token; 
       }
       else
       {
           $resp["status"] = 401;
       }
    }
    else
    {  
        $resp["status"] = 400;
    }

   return $response->withJson($resp,200);
   }


   public function TraerEmpleado($request,$response,$args)
   {
       $usuario = $args['Usuario'];
       $empleado = Empleado::TraerElEmpleadoPorUsuario($usuario);
       return $response->withJson($empleado,200);
   }

   public function CerrarSesion($request, $response, $args)
   {
       $resp["status"] = 200;
       $id = Sesion::TraerUltimoIdAgregado();
       $sesion = Sesion::TraerSesionPorId($id);     
       if($sesion == false)
       {
           $resp["status"] = 400;
       }
        $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
        $fecha_salida = $dateTime->format("m/d/Y g:i A");
        $sesion->SetFechaSalida($dateTime->format("m/d/Y g:i A"));
        Sesion::ModificarSesionSalida($sesion);
        return $response->withJson($resp);
   }

   
 public function TraerSesiones($request, $response, $args)
 {
     $arraySesiones = Sesion::TraerTodasLasSesiones();
     $arrayEmpleados = Empleado::TraerTodosLosEmpleados();
     $resp["sesiones"] = $arraySesiones;
     $resp["empleados"] = $arrayEmpleados;
     return $response->withJson($resp);
 }

}

?>