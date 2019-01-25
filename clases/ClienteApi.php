<?php
require_once("Empleado.php");
require_once("Cliente.php");
require_once("Roles.php");
require_once("Pedidos.php");
include_once("../bd/AccesoDatos.php");
require_once("Operaciones.php");
include_once("../phpExcel/Classes/PHPExcel.php");
include_once('../fpdf/fpdf.php');
// include composer autoload
require 'autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class ClienteApi
{


public function IngresarCliente($request,$response,$args)
{
$data = $request->getParsedBody();
$resp["status"] = 404;
if(!Cliente::VerificarCliente($data["Usuario"],$data["clave"]))
{


$cliente = new Cliente();
$resp["status"] = 200;
if($data["Nombre"]=="" || $data["Apellido"]=="" || $data["Usuario"]=="" || $data["clave"]=="")
{
   $resp["status"] = 402;
   return $response->withJson($resp);
}
$cliente->SetNombre($data["Nombre"]);
$cliente->SetApellido($data["Apellido"]);
$cliente->SetUsuario($data["Usuario"]);
$cliente->SetClave($data["clave"]);
$cliente->SetId_rol(6);

    if(!Cliente::InsertarElCliente($cliente))
    {
        $resp["status"] = 403;
    }
}
return $response->withJson($resp);

}

public function TraerClientes($request, $response, $args)
{
$arrayClientes = Cliente::TraerTodosLosClientes();
$resp["cliente"] = $arrayClientes;
return $response->withJson($resp);
}

public function TraerElCliente($request, $response, $args)
{
$Usuario = $args['Usuario'];
$cliente = Cliente::TraerElClientePorUsuario($Usuario);
if($cliente == false)
{
    $resp["status"] = 400;
    $response = $response->withJson($resp);
}
else 
{
    $resp["cliente"] = $cliente;
}

return $response->withJson($resp);
}

}

?>