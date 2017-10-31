<?php

class Helado
{

public $sabor;
public $tipo;
public $precio;
public $cantidad;



public function __construct()
{
   
}

public static function TraerHelado($id) 
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM helado where id = '$id'");
        $consulta->execute();
        $heladoBuscado= $consulta->fetchObject('helado');
        return $heladoBuscado;				

        
}


public function TraerUno($request, $response, $args) {
    $id=$args['id'];
   $elCd=cd::TraerUnCd($id);
    $newResponse = $response->withJson($elCd, 200);  
   return $newResponse;
}



}
?>