<?php
require_once 'Usuario.php';



class usuarioApi extends Usuario
{

   /* $id=$args['id'];
    $elCd=cd::TraerUnCd($id);
     $newResponse = $response->withJson($elCd, 200);  
    return $newResponse;*/

    public function Validar($email,$clave) {
    
        $response="";
        $retorno=false;
        $miArray=array();
        $usuario=Usuario::TraerUsuarios();
        if(isset($usuario))
        {  
   
    foreach($usuario as $item)
        {

        if($item->GetEmail()==$email && $item->GetClave()==$clave)
          {

               $response= "Bienvenido";
               return $response;
          }
          if($item->GetEmail()==$email && $item->GetClave()!=$clave)
          {
              $response=  "Es mal la clave";
            
          }

          if($item->GetEmail()!=$email && $item->GetClave()==$clave)
          {
              $response="Esta mal ingresado el mail";
           
          }
          if($item->GetEmail()!=$email && $item->GetClave()!=$clave)
          {
              $response="Esta mal ingresado el mail y la clave";
           
          }
        }
    
     }
     return $response;

       

   }


}

?>