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
       if($empleado->habilitado == "si")
       {
       $resp["status"] = 200;
       $cargos = Roles::TraerRoles();
       $resp["id"] = $empleado->Getid_empleado();
       foreach($roles as $rolEmpleado)
       {
           if($rolEmpleado->Id_rol == $empleado->Id_rol)
           {
               $resp["tipo"] = $rolEmpleado->Descripcion;
               break;
           }
       }
       $sesion = new Sesion();
       $sesion->SetIdEmpleado($empleado->id_empleado);
       $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
       $fecha_ingreso = $dateTime->format("m/d/Y g:i A");
       $sesion->SetFechaIngreso($fecha_ingreso);
    //    $sesion->SetFechaIngreso($datos["fecha_ingreso"]);
       Sesion::InsertarSesionInicio($sesion);
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