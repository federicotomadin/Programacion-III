<?php

include_once "usuario.php";


class UsuarioApi extends Usuario
{

    public static function TraerUsuarioNombre($nombre) {
      
       $usuarioNombre=Usuario::TraerElUsuarioPorNombre($nombre);
  
       return $response->withJson($usuarioNombre, 200);  
      

     
    }




}





?>