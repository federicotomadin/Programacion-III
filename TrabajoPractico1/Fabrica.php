<?php

include_once "Empleado.php";
include_once "Persona.php";


class Fabrica
{

public $_Empleado=array();
public $_razonSocial;


public function __construct($razonSocial)
{
    $this->_Empleado[]="";
    $this->_razonSocial=$razonSocial;
}

public function AgregarEmpleado($Empleado)
{
    array_push($this->_Empleado,$Empleado);
}


public function CalcularSueldos()
{
    $acum=0;
    foreach($this->_Empleado as $item => $legajo)
    {
       echo "indicie de mi array $_Empleado ";
    }
}

 function EliminarEmpleado($empleado)
{
     unset($this->_Empleado[$empleado]);
}





}




?>