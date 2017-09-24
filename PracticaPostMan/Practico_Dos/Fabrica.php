<?php

include_once "Empleado.php";
include_once "Persona.php";


class Fabrica
{

public $_Empleados;
public $_razonSocial;


public function __construct($razonSocial)
{
    $this->_Empleados=array();
    $this->_razonSocial=$razonSocial;
}

public function AgregarEmpleado($Empleado)
{
    array_push($this->_Empleados,$Empleado);
}


public function CalcularSueldos()
{
    $acum=0;
    foreach($this->_Empleados as $item)
    {
       $acum+=$item->getSueldo();
    }
    return $acum;
}

 function EliminarEmpleado($empleado)
{
  
for($i=0;$i<count($this->_Empleados);$i++)
{
    if($this->_Empleados[$i]==$empleado)
    {
        unset($this->_Empleados[$i]);
    }
}

}

public function EliminarEmpleadosRepetidos()
{
  return array_unique($this->_Empleados);
}

public function ToString()
{
    echo "Razon Social  ".$this->_razonSocial."<br>";
    echo "Empleados"."<br>";
   
    for($i=0; $i < count($this->_Empleados);$i++)
    {
      $this->_Empleados[$i]->toString();
    }
  
   
}

}