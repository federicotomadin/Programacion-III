<?php


require_once "bicicleta.php";

class bicicletaApi extends bicicleta
{

    public function traerUno($request, $response, $args) {
        $id=$args['id'];
        $Bicicleta=Bicicleta::TraerLaBicicletaPorId($id);
        $newResponse = $response->withJson($Bicicleta, 200);  
       return $newResponse;
   }

   public function traerTodos($request, $response, $args) {   
    $todasLasBicicletas=Bicicleta::TraerTodasLasBicicletas();
   $newResponse = $response->withJson($todasLasBicicletas, 200);  
   return $newResponse;
}


public function traerTodosPorColor($request, $response, $args) {
    $color=$args['color'];
    $todasLasBicicletas=Bicicleta::TraerTodasLasBicicletasPorColor($color);
   $newResponse = $response->withJson($todasLasBicicletas, 200);  
   return $newResponse;
}


public function CargarUno($request, $response, $args) {
    $ArrayDeParametros = $request->getParsedBody();
    
    $archivos = $request->getUploadedFiles();
    $destino="./fotos/";
    $nombreAnterior=$archivos['foto']->getClientFilename();
    $extension= explode(".", $nombreAnterior);
    $extension=array_reverse($extension);



  $miBicicleta = new Bicicleta();
  $miBicicleta->color=$ArrayDeParametros['color'];
  $miBicicleta->rodado=$ArrayDeParametros['rodado'];
  $miBicicleta->marca=$ArrayDeParametros['marca'];
  $miBicicleta->foto=$miBicicleta->marca.$miBicicleta->rodado.'.'.$extension[0];
  $id=Bicicleta::InsertarLaBicicleta($miBicicleta);


  $archivos['foto']->moveTo($destino.$miBicicleta->marca.$miBicicleta->rodado.".".$extension[0]);
  $response->getBody()->write("se guardo la bicicleta");



  return $response;
}


public function BorrarUno($request, $response, $args) {
    $ArrayDeParametros = $request->getParsedBody();
    $id=$ArrayDeParametros['id'];
    $Bicicleta= new Bicicleta();
   // $objeto=Bicicleta::TraerLaBicicletaPorId($id);
   // $destino="./backup/";


   /* if(copy("./FotosVentas/".$id.$objeto->foto,"./backup/".$id.$objeto->foto))
    {
      unlink("./FotosVentas/".$id.$objeto->foto);
    }*/

    $cantidadDeBorrados=$Bicicleta->BorrarLaBicicleta($id);

 
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

  


   $miBicicleta = new Bicicleta();
   $miBicicleta->id=$ArrayDeParametros['id'];
   $miBicicleta->color=$ArrayDeParametros['color'];
   $miBicicleta->rodado=$ArrayDeParametros['rodado'];
   $miBicicleta->marca=$ArrayDeParametros['marca'];

   $Insertado=Bicicleta::TraerLaBicicletaPorId($miBicicleta->id);
   $miBicicleta->foto=$Insertado->foto; 
   if(Bicicleta::VerificarId($miBicicleta->foto))
   {
   
    copy("./fotos/".$miBicicleta->foto,"fotos/backup/".$miBicicleta->foto);
  
   }

 
      $resultado =Bicicleta::ModificarBicicletaParametros($miBicicleta);
      $objDelaRespuesta= new stdclass();
   //var_dump($resultado);
   //die();
   $objDelaRespuesta->resultado=$resultado;
   return $response->withJson($objDelaRespuesta, 200);		
}







}