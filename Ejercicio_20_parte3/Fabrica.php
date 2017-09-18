<?php


class Fabrica
{

private $_cantMax;
public $_operarios=array();
private $_razonSocial;


public function __Fabrica($razonSocial)
{
  
    $this->_razonSocial=$razonSocial;
    $this->_cantMax=5;
}



public function Add($operario)
{
    if(count($this->_operarios)<5)
    {
        array_push($this->_operarios,$operario);
        return true;
    }
    else return false;

}

private function RetornarCostos()
{
   $acum=0;
    foreach($this->_operarios as $item)
    {
        $acum= $acum + $item->GetSueldo();

    }
  echo  $acum;
}

public static function MostrarCostos($fabrica)
{
    $fabrica->RetornarCostos();
}

private function MostrarOperarios()
{
    foreach($this->_operarios as $item)
    {
        $item->MostrarOperarios();
    }
}

public function Equals($fabrica,$operario)
{
    foreach($fabrica->_operarios as $item)
    {
        if($item->Equals($operario))
        {
            return true;
        }
    }
    return false;
}

public function Remove($operario)
{
    for($i=0;$i<count($this->_operarios);$i++)
    {
        if($this->_operarios[$i]==$operario )
        {
            unset($this->_operarios[$i]);
        }
    }
    return false;
   
}





}




?>