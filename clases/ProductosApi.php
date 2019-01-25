<?php
require_once("Productos.php");
include_once("../bd/AccesoDatos.php");
require 'autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class ProductosApi
{

public function TraerTodosLosProductos($request,$response,$args)
{

$productos= Productos::TraerTodosLosProductos();
if($productos==null)
{
    $resp["status"]=400;
}
else 
{
    $resp["status"]=200;
    $resp["productos"]=$productos;
}

return $response->withJson($resp);

}

public function ModificarProducto($request,$response,$args)
{
$id = $args['id'];
$id = intval($id);
$resp["status"] = 200;
$data = $request->getParsedBody();
$Producto = Productos::TraerProductoPorId($id);

$Producto->Nombre=$data["Nombre"];
$Producto->Descripcion=$data["Descripcion"];
$Producto->Precio=$data["Precio"];

if(!Productos::ModificarProducto($Producto))
{
    $resp["status"] = 400;
}
return $response->withJson($resp);
}

public function TraerProducto($request,$response,$args)
{ 
    $id = $args['id'];
    $Producto = Productos::TraerProductoPorId($id);
    return $response->withJson($Producto);

}

public function BorrarProducto($request,$response,$args)
{
    $id = $args['id'];
    $id = intval($id);
    $resp["status"] = 200;

    if(!Productos::BorrarProducto($id))
    {
        $resp["status"] = 400;
    }

    return $response->withJson($resp);

}

public function InsertarProducto($request,$response,$args)
{
   $data = $request->getParsedBody();
   $resp["status"] = 200;
   $Producto = new Productos();

   $Producto->Nombre=$data["Nombre"];
   $Producto->Descripcion=$data["Descripcion"];
   $Producto->Precio=$data["Precio"];
   $Producto->id_rol=$data["id_rol"];

   if(!Productos::InsertarProducto($Producto))
    {
       $resp["status"] = 400;
    }

   return $response->withJson($resp);
}

}

?>