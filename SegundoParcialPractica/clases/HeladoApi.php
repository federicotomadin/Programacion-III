<?php

require_once 'Helado.php';


class HeladoApi extends Helado 
{

    public function traerUno($request, $response, $args) {
        $id=$args['id'];
        $elHelado=Helado::TraerUnHelado($id);
        $newResponse = $response->withJson($elHelado, 200);  
       return $newResponse;
   }

   public function traerTodos($request, $response, $args) {
    $todosLosHelados=Helado::TraerTodosLosHelados();
   $newResponse = $response->withJson($todosLosHelados, 200);  
  return $newResponse;
}


public function CargarUno($request, $response, $args) {
    $ArrayDeParametros = $request->getParsedBody();
 // var_dump($ArrayDeParametros);
  $sabor= $ArrayDeParametros['sabor'];
  $tipo= $ArrayDeParametros['tipo'];
  $precio= $ArrayDeParametros['precio'];
  $cantidad= $ArrayDeParametros['cantidad'];
  
  $miHelado = new Helado();
  $miHelado->sabor=$sabor;
  $miHelado->tipo=$tipo;
  $miHelado->precio=$precio;
  $miHelado->cantidad=$cantidad;
  $id=$miHelado->InsertarElHeladoParametros();

  $archivos = $request->getUploadedFiles();
  $destino="./fotos/";
  //var_dump($archivos);
  //var_dump($archivos['foto']);

  $nombreAnterior=$archivos['foto']->getClientFilename();
  $extension= explode(".", $nombreAnterior)  ;
  //var_dump($nombreAnterior);
  $extension=array_reverse($extension);

  $archivos['foto']->moveTo($destino.$id.$sabor.".".$extension[0]);
  $response->getBody()->write("se guardo el helado");

  return $response;
}


public function BorrarUno($request, $response, $args) {
    $ArrayDeParametros = $request->getParsedBody();
    $id=$ArrayDeParametros['id'];
    $helado= new Helado();
    $helado->id=$id;
    var_dump($helado->sabor);
    die();
    $cantidadDeBorrados=$helado->BorrarHelado();

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

public function ModificarUno($request, $response, $args) {
    //$response->getBody()->write("<h1>Modificar  uno</h1>");
    $ArrayDeParametros = $request->getParsedBody();
  // var_dump($request->getParsedBody());    
   $miHelado = new Helado();
   $miHelado->id=$ArrayDeParametros['id'];
   $miHelado->sabor=$ArrayDeParametros['sabor'];
   $miHelado->tipo=$ArrayDeParametros['tipo'];
   $miHelado->precio=$ArrayDeParametros['precio'];
   $miHelado->cantidad=$ArrayDeParametros['cantidad'];

      $resultado =$miHelado->ModificarHeladoParametros();
      $objDelaRespuesta= new stdclass();
   //var_dump($resultado);
   //die();
   $objDelaRespuesta->resultado=$resultado;
   return $response->withJson($objDelaRespuesta, 200);		
}


}