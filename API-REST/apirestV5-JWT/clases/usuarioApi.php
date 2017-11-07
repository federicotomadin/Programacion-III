<?php
require_once 'usuario.php';



class usuarioApi extends usuario
{

   /* $id=$args['id'];
    $elCd=cd::TraerUnCd($id);
     $newResponse = $response->withJson($elCd, 200);  
    return $newResponse;*/

    public function Validar($nombre,$clave) {
        $retorno=false;
        $usuario=usuario::TraerUsuario();
        $newResponse = $response->withJson($usuario, 200);  
        var_dump($newResponse);
        die();

        if(isset($usuario))
        {
        foreach($usuario as $item)
        {
            if($item->GetNombre() == $nombre && $item->GetClave() == $clave)
            {
                $retorno = true;
            }
        }
    }

        return $retorno;

   }


}