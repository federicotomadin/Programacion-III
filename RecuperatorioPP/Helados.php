<?php

class Helado
{

public $_sabor;
public $_tipo;
public $_precio;
public $_cantidad;


public function __Helado($sabor,$tipo,$precio,$cantidad)
{
    $this->_sabor=$sabor;
    $this->_tipor=$tipo;
    $this->_precio=$precio;
    $this->_cantidad=$cantidad;
}

public static function AltaHelado($helado)
{
    $heladoJson= json_encode($helado);
    $pFile= fopen("./Archivos/helados.txt","r");
    fwrite($pFile,$heladoJson);
    fclose($pFile);
}


public static function TraerHelados()
{
  $helados=array();
  $pFile = fopen("./Archivos/helados.txt","r");

  var_dump($pFile);
  die();




}

}




?>