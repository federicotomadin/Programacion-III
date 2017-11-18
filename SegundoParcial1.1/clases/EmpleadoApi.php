<?php

require_once "Empleado.php";


class EmpleadoApi extends Empleado
{


    public function traerUno($request, $response, $args) {
        $id=$args['id'];
        $elEmpleado=Empleado::TraerUnEmpleado($id);
        $newResponse = $response->withJson($elEmpleado, 200);  
       return $newResponse;
   }

   public function traerTodos($request, $response, $args) {
    $todosLosEmpleados=Empleado::TraerTodosLosEmpleados();
   $newResponse = $response->withJson($todosLosEmpleados, 200);  
   return $newResponse;
}

public function CargarUno($request, $response, $args) {
    $ArrayDeParametros = $request->getParsedBody();
    $archivos = $request->getUploadedFiles();
    $destino="./fotos/";
    $nombreAnterior=$archivos['foto']->getClientFilename();
    $extension= explode(".", $nombreAnterior);
    $extension=array_reverse($extension);



  $miEmpleado = new Empleado();
  $miEmpleado->nombre=$ArrayDeParametros['nombre'];
  $miEmpleado->apellido=$ArrayDeParametros['apellido'];
  $miEmpleado->legajo=$ArrayDeParametros['legajo'];
  $miEmpleado->email=$ArrayDeParametros['email'];
  $miEmpleado->clave=$ArrayDeParametros['clave'];
  $miEmpleado->perfil= $ArrayDeParametros['perfil'];
  $miEmpleado->foto=$miEmpleado->apellido.".".$extension[0];
  $id=$miEmpleado->InsertarElEmpleado();



  $archivos['foto']->moveTo($destino.$id.$miEmpleado->apellido.".".$extension[0]);
  $response->getBody()->write("se guardo el empleado");

  return $response;
}

public function BorrarUno($request, $response, $args) {
    $ArrayDeParametros = $request->getParsedBody();
    $id=$ArrayDeParametros['id'];
    $Empleado= new Empleado();
    $objeto=Empleado::TraerUnEmpleado($id);
    $destino="./backup/";


    if(copy("./fotos/".$id.$objeto->foto,"./backup/".$id.$objeto->foto))
    {
      unlink("./fotos/".$id.$objeto->foto);
    }

    $cantidadDeBorrados=$Empleado->BorrarEmpleado($id);

 
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


   $miEmpleado = new Empleado();
   $miEmpleado->id=$ArrayDeParametros['id'];
   $miEmpleado->nombre=$ArrayDeParametros['nombre'];
   $miEmpleado->apellido=$ArrayDeParametros['apellido'];
   $miEmpleado->email=$ArrayDeParametros['email'];
   $miEmpleado->legajo=$ArrayDeParametros['legajo'];
   $miEmpleado->clave=$ArrayDeParametros['clave'];
   $miEmpleado->perfil=$ArrayDeParametros['perfil'];
   $miEmpleado->foto=$ArrayDeParametros['foto'];

   var_dump($miEmpleado);
   die();

 
      $resultado =Empleado::ModificarEmpleadoParametros($miEmpleado);
      $objDelaRespuesta= new stdclass();
   //var_dump($resultado);
   //die();
   $objDelaRespuesta->resultado=$resultado;
   return $response->withJson($objDelaRespuesta, 200);		
}

public static function VerificaEmpleado($email,$clave,$perfil) {
    
        $response="";
        $retorno=false;
        $miArray=array();
        $empleado=Empleado::TraerTodosLosEmpleados();
        if(isset($empleado))
        {  
   
           
    foreach($empleado as $item)
        {
          
        if($item->email==$email && $item->clave==$clave && $item->perfil==$perfil)
          {
           

               $response= "Bienvenido";
               return $response;
          }

          if($item->email==$email && $item->clave!=$clave)
          {
              $response=  "Es mal la clave";
            
          }

          if($item->email!=$email && $item->clave==$clave)
          {
              $response="Esta mal ingresado el mail";
           
          }
        }
       
}
return $response;
}


}

