<?php

include_once "Empleado.php";
include_once "Persona.php";


class Fabrica
{

public $_Empleado;
public $_razonSocial;


public function __construct($razonSocial)
{
    $this->_Empleado=array();
    $this->_razonSocial=$razonSocial;
}

public function AgregarEmpleado($Empleado)
{
    array_push($this->_Empleado,$Empleado);
}


public function CalcularSueldos()
{
    $acum=0;
    foreach($this->_Empleado as $item)
    {
       $acum+=$item->getSueldo();
    }
    return $acum;
}

 function EliminarEmpleado($empleado)
{
  
for($i=0;$i<count($this->_Empleado);$i++)
{
    if($this->_Empleado[$i]==$empleado)
    {
        unset($this->_Empleado[$i]);
    }
}

}

public function EliminarEmpleadosRepetidos()
{
  return array_unique($this->_Empleado);
}

public function ToString()
{
    echo "Razon Social  ".$this->_razonSocial."<br>";
    echo "Empleados"."<br>";
    foreach($this->_Empleado as $item)
    {
        $item->ToString();
    }
}






}




?>