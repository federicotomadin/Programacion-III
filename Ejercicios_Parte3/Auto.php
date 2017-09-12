<?php


Class Auto
{

private $_color;
private $_precio;
private $_marca;
private $_fecha;


public function getColor()
{
    return $this->_color;
}

public function getPrecio()
{
    return $this->_precio;
}

public function getMarca()
{
    return $this->_marca;
}

public function getFecha()
{
    return $this->_fecha;
}


public function __Auto($marca,$color,$precio=null,$fecha=null)
{
    $this->_marca=$marca;
    $this->color=$color;
    if($precio<>null)
  {
    $this->_precio=$precio;
  }
  
    if($fecha<>null)
    {
    $this->fecha;
    }
}   



public static function AgregarImpustos($impuesto)
{
    $this->_precio+=$impuesto;
}

public static function MostrarAuto($Auto)
{
    echo "Marca ".$this->_marca."<br>";
    echo "Color ".$this->_color."<br>";
    echo "Precio ".$this->_precio."<br>";
    echo "Fecha ".$this->_fecha."<br>";
}


public function Equals($Auto)
{
    if($this->_marca==$Auto->getMarca())
    return true;
    else return false;
}


public static function Add($AutoUno,$AutoDos)
{
    
}





}

?>