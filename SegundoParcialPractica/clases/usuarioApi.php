<?php
require_once 'Usuario.php';



class usuarioApi extends Usuario
{

   /* $id=$args['id'];
    $elCd=cd::TraerUnCd($id);
     $newResponse = $response->withJson($elCd, 200);  
    return $newResponse;*/

    public function Validar($email,$clave) {
        $retorno=false;
        $miArray=array();
        $usuario=Usuario::TraerUsuario();
        if(isset($usuario))
        {
        if($usuario->email==$email && $usuario->clave==$clave)
          {
                $retorno = true;
            }
        }
    

        return $retorno;

   }


}

?>