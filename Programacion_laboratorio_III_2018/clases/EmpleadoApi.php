<?php
require_once("Empleado.php");
require_once("Roles.php");
//include_once("cochera.php");
//include_once("auto.php");
//include_once("cargo_empleado.php");
include_once("../bd/AccesoDatos.php");
//include_once("../phpExcel/Classes/PHPExcel.php");
//include_once('../fpdf/fpdf.php');
// include composer autoload
require 'autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class EmpleadoApi
{
public function IngresarEmpleado($request,$response,$args)
{
$data = $request->getParsedBody();


if(!VerificarEmpleado($data["Usuario"],$data["Clave"]))
{
 
$resp["status"] = 200;
$resp["nombre"] = $data["Nombre"];

$empleado = new Empleado();

$empleado->SetNombre($data["Nombre"]);
$empleado->SetApellido($data["Apellido"]);
$empleado->SetUsuario($data["Nombre"] + $data["Apellido"]);
$empleado->SetClave($data["Clave"]);

if(TraerIdRol($data["Rol"]))
{
 $empleado->SetId_rol($data["Rol"]);
}
$empleado->SetSueldo($data["Sueldo"]);
$empleado->SetHabilitado($data["Habilitado"]);

$idEmpleado = Empleado::TraerUltimoIdAgregado();
$idEmpleado = intval($idEmpleado);
$idEmpleadoFoto = $idEmpleado+3;
$destino = "../fotosEmpleados/";
$files = $request->getUploadedFiles();
$nombreAnterior = $files['foto']->getClientFilename();
$extension= explode(".", $nombreAnterior) ;
$extension=array_reverse($extension);
$files['foto']->moveTo($destino.$idEmpleadoFoto.$data["Nombre"].$data["Apellido"].".".$extension[0]);
$empleado->SetFoto($idEmpleadoFoto.$data["Nombre"].$data["Apellido"].".".$extension[0]);
if(!Empleado::InsertarElEmpleado($empleado))
{
    $resp["status"] = 400;
}
return $response->withJson($resp);
}
}

public function TraerEmpleados($request, $response, $args)
{
$arrayEmpleados = Empleado::TraerTodosLosEmpleados();
for($i = 0; $i < count($arrayEmpleados); $i++)
{
    $password = str_repeat("*", strlen($arrayEmpleados[$i]->clave));
    $arrayEmpleados[$i]->clave = $password;
}
$resp["empleados"] = $arrayEmpleados;
$response = $response->withJson($resp);
return $response;
}

public function TraerElEmpleado($request, $response, $args)
{
$Usuario = $args['Usuario'];
$empleado = Empleado::TraerElEmpleadoPorUsuario($Usuario);
if($empleado == false)
{
    $resp["status"] = 400;
    $response = $response->withJson($resp);
}
else
{
$password = str_repeat("*", strlen($empleado->clave));
$empleado->clave = $password;
$response = $response->withJson($empleado);
}
return $response;
}


public function BorrarEmpleado($request, $response, $args)
{
$id = $args['id'];
$id = intval($id);
$resp["status"] = 200;
if(!Empleado::BorrarElEmpleado($id))
{
    $resp["status"] = 400;
}
return $response->withJson($resp);
}

public function ModificarEmpleado($request,$response,$args)
{
$id = $args['id'];
$id = intval($id);
$resp["status"] = 200;
$data = $request->getParsedBody();
$empleado = Empleado::TraerElEmpleado($id);
$empleado->SetNombre($data["Nombre"]);
$empleado->SetApellido($data["Apellido"]);
$empleado->SetUsuario($data["Usuario"]);
$empleado->SetClave($data["Clave"]);
$empleado->SetId_rol($data["Id_rol"]);
$empleado->SetSueldo($data["Sueldo"]);
$empleado->SetHabilitado("si");
$fotosEmpleados = '../fotosEmpleados/';
$fotosBackup = '../fotosEmpleados/Backup/';
$arrayFotosBackup = scandir($fotosBackup);
$arrayFotosEmpleado = scandir($fotosEmpleados);
$pathFoto = explode('/',$empleado->GetFoto());
if(file_exists($fotosEmpleados.$empleado->GetFoto()))
{
    if($pathFoto[0] == "Backup")
{
     for($i = 0; $i < count($arrayFotosBackup); $i++)
   {
   $archivo = pathinfo($arrayFotosBackup[$i]);     
   if("Backup/".$archivo["basename"] == $empleado->foto)
      {
        if(rename("../fotosEmpleados/Backup/".$archivo["basename"],"../fotosEmpleados/Backup/".$id.$data["Nombre"].$data["Apellido"].".".$archivo["extension"]));
            {
                $empleado->SetFoto("Backup/".$id.$data["Nombre"].$data["Apellido"].".".$archivo["extension"]);
            }
      }
   }
}
else
{
 for($i = 0; $i < count($arrayFotosEmpleado); $i++)
{
   $archivo = pathinfo($arrayFotosEmpleado[$i]);     
   if($archivo["basename"] == $empleado->foto)
      {
        if(rename("../fotosEmpleados/".$archivo["basename"],"../fotosEmpleados/Backup/".$id.$data["Nombre"].$data["Apellido"].".".$archivo["extension"]));
            {
                $empleado->SetFoto("Backup/".$id.$data["Nombre"].$data["Apellido"].".".$archivo["extension"]);
            }
      }
    }
}
}

if(!Empleado::ModificarElEmpleado($empleado))
{
    $resp["status"] = 400;
}
return $response->withJson($resp);
}


public function SuspenderEmpleado($request,$response,$args)
{
    $data = $request->getParsedBody();
    $resp["status"] = 200;
    $id = $args['id'];
    $id = intval($id);
    $empleado = Empleado::TraerElEmpleado($id);
    if($empleado == false)
    {
        $resp["status"] = 400;
    }
    else
    {
    $empleado->SetHabilitado("no");
    if(!Empleado::SuspenderEmpleado($empleado))
    {
        $resp["status"] = 400;
    }
    }
    return $response->withJson($resp);
}

public function HabilitarEmpleado($request,$response,$args)
{
    $data = $request->getParsedBody();
    $resp["status"] = 200;
    $id = $args['id'];
    $id = intval($id);
    $empleado = Empleado::TraerElEmpleado($id);
    if($empleado == false)
    {
        $resp["status"] = 400;
    }
    else
    {
    $empleado->SetHabilitado("si");
    if(!Empleado::SuspenderEmpleado($empleado))
    {
        $resp["status"] = 400;
    }
    }
    return $response->withJson($resp);
}


public function VerSesionesEmpleado($request, $response, $args)
{
$id = $args['id'];
$id = intval($id);
$empleado = Empleado::TraerElEmpleado($id);
if($empleado == false)
{
    $resp["status "] = 400;
}
else
{
    $sesiones = Empleado::TraerFechasDeSesionesPorIdEmpleado($empleado->id);
    $password = str_repeat("*", strlen($empleado->clave));
    $empleado->clave = $password;
    $resp["empleado"] = $empleado;
    $resp["sesiones"] = $sesiones;
}
return $response->withJson($resp);
}


public function VerCantidadOperacionesEmpleado($request, $response, $args)
{
$id = $args['id'];
$id = intval($id);
$empleado = Empleado::TraerElEmpleado($id);
if($empleado == false)
{
    $resp["status "] = 400;
}
else
{
    $password = str_repeat("*", strlen($empleado->Clave));
    $empleado->clave = $password;
    $operacionesEntrada = Empleado::TraerOperacionesEntradaPorIdEmpleado($empleado->id_empleado);
    $cantidadOperacionesEntrada = count($operacionesEntrada);
    $resp["empleado"] = $empleado;
    if($cantidadOperacionesEntrada == 0)
    {
        $operacionesEntrada = "EL EMPLEADO NO TIENE OPERACIONES DE ENTRADA";
    }
    $resp["empleado"] = $empleado;
    $resp["operacionesEntrada"] = $operacionesEntrada;
    $resp["cantidadOperacionesEntrada"] = $cantidadOperacionesEntrada;
}
return $response->withJson($resp);
}


public function VerCantidadOperacionesListadaPorEmpleado($request, $response, $args)
{

$arrayEmpleados = Empleado::TraerTodosLosEmpleados();

if($arrayEmpleados == false)
{
    $resp["status "] = 400;
}
else
{
for($i = 0; $i < count($arrayEmpleados); $i++)
{
    $password = str_repeat("*", strlen($arrayEmpleados[$i]->Clave));
    $arrayEmpleados[$i]->clave = $password;
    $operacionesEntrada = Empleado::TraerOperacionesEntradaPorIdEmpleado($arrayEmpleados[$i]->id_empleado);
    $cantidadOperacionesEntrada = count($operacionesEntrada);
    if($cantidadOperacionesEntrada == 0)
    {
        $operacionesEntrada = "EL EMPLEADO  "$arrayEmpleados[$i]->Nombre"  NO TIENE OPERACIONES DE ENTRADA";
    }
    $resp["empleado"] += $empleado;
    $resp["operacionesEntrada"] += $operacionesEntrada;
    $resp["cantidadOperacionesEntrada"] += $cantidadOperacionesEntrada;
}

   
}
return $response->withJson($resp);
}


public function VerCantidadOperacionesListadaPorEmpleado($request, $response, $args)
{

$roles = Roles::TraerRoles();

if($roles == false)
{
    $resp["status "] = 400;
}
else
{
for($i = 0; $i < count($roles); $i++)
{

    $operaciones = Empleado::TraerOperacionesPorSector($roles[$i]->Id_rol);
    $cantidadOperaciones = count($operaciones);
    if($cantidadOperaciones == 0)
    {
        $operaciones = "EL ROL  "$roles[$i]->Descripcion"  NO TIENE OPERACIONES ";
    }
    $resp["rol"] += $roles[$i]->Descripcion;
    $resp["operaciones"] += $operaciones;
    $resp["cantidadOperaciones"] += $cantidadOperaciones;
}

   
}
return $response->withJson($resp);
}




}


?>