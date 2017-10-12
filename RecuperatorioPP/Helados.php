<?php

class Helado
{

public $sabor;
public $tipo;
public $precio;
public $cantidad;


public function Helado($sabor,$tipo,$precio,$cantidad)
{
    $this->sabor=$sabor;
    $this->tipo=$tipo;
    $this->precio=$precio;
    $this->cantidad=$cantidad;
}

public static function AltaHelado($helado)
{
    $heladoJson= json_encode($helado);
    $pFile= fopen("Archivos/helados.txt","a");
    fwrite($pFile,$heladoJson."\n");
    fclose($pFile);
}


public static function TraerHelados()
{
  $helados=array();
  $pFile = fopen("Archivos/helados.txt","r");
  while(!feof($pFile))
  {
      $aux=json_decode(fgets($pFile),true);
      array_push($helados,new Helado($aux["sabor"],$aux["tipo"],$aux["precio"],$aux["cantidad"]));
  }
  fclose($pFile);
  return $helados;

}


public static function BuscarHelado($sabor,$tipo)
{
    $helados=Helado::TraerHelados();
    $varAux=false;
    $varAux2=false;

    foreach($helados as $item)
    {
        if($item->sabor==$sabor)
        {
            $varAux=true;
        }
        if($item->tipo==$tipo)
        {
            $varAux2=true;
        }

    }

    if($varAux==true && $varAux2==true)
    {
        echo "SI HAY";
    }

    if(!$varAux2 && !$varAux)
    {
        echo "No existe  el sabor ni el tipo ";
        exit;
    }

    if(!$varAux)
    {
        echo "No existe el sabor ";
    }

    if(!$varAux2)
    {
        echo "No existe el tipo ";
    }
    
}




}




?>