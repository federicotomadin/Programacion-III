<?php

require_once 'Producto.php';


class ProductoApi extends Producto
{

    public function traerUno($request, $response, $args) {
        $id=$args['id'];
        $elProducto=Producto::TraerUnProducto($id);
        $newResponse = $response->withJson($elProducto, 200);  
       return $newResponse;
   }

   public function traerTodos($request, $response, $args) {
    $todosLosProductos=Producto::TraerTodosLosProductos();
   $newResponse = $response->withJson($todosLosProductos, 200);  
   return $newResponse;
}

public function CargarUno($request, $response, $args) {
    $ArrayDeParametros = $request->getParsedBody();


  $miProducto = new Producto();
  $miProducto->nombre=$ArrayDeParametros['nombre'];
  $miProducto->precio=$ArrayDeParametros['precio'];
  $id=$miProducto->InsertarElProducto();



  $response->getBody()->write("se guardo el producto");

  return $response;
}


public function ModificarUno($request, $response, $args) {
    //$response->getBody()->write("<h1>Modificar  uno</h1>");
    $ArrayDeParametros = $request->getParsedBody();
//  var_dump($request->getParsedBody());   

   $miProducto = new Producto();
   $miProducto->id=$ArrayDeParametros['id'];
   $miProducto->nombre=$ArrayDeParametros['nombre'];
   $miProducto->precio=$ArrayDeParametros['precio'];

 
   
      $resultado =$miProducto->ModificarProductoParametros($miProducto);
      $objDelaRespuesta= new stdclass();
   //var_dump($resultado);
   //die();
   $objDelaRespuesta->resultado=$resultado;
   return $response->withJson($objDelaRespuesta, 200);		
}


public function BorrarUno($request, $response, $args) {
    $ArrayDeParametros = $request->getParsedBody();
    $id=$ArrayDeParametros['id'];
    $producto=new Producto();

    $cantidadDeBorrados=$producto->BorrarProducto($id);

    $objDelaRespuesta= new stdclass();
    $objDelaRespuesta->cantidad=$cantidadDeBorrados;

   if($cantidadDeBorrados>0)
       {
            $objDelaRespuesta->resultado="algo borro!!!";
       }
       else
       {
           $objDelaRespuesta->resultado="no Borro nada!!!";
       }
   $newResponse = $response->withJson($objDelaRespuesta, 200);  
     return $newResponse;
}


}