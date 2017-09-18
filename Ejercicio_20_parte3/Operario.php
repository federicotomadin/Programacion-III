<?php


class Operario
{
private $_apellido;
private $_legajo;
private $_nombre;
private $_salario;



public function __Construct($legajo,$apellido,$nombre,$salario=null)
{
   $this->_legajo=$legajo;
   $this->_apellido=$apellido;
   $this->_nombre=$nombre;
   if($salario<>null)
   {
       $this->_salario=$salario;
   }
}

public function GetSueldo()
{
    return $this->_salario;
}


public function Equals($operario)
{
   if($this->_nombre==$operario->_nombre and $this->_apellido==$operario->_apellido and $this->_legajo==$operario->_legajo);
   {
       return true;
   }
return false;
}

public function getNombreApellido()
{
    return "Nombre ".$this->_nombre.","."Apellido ".$this->_apellido."<br>";
}

public function getSalario()
{
    return "Salario ".$this->_salario."<br>";
}

public function Mostrar()
{
    echo $this->getNombreApellido();
    echo "Legajo ".$this->_legajo."<br>";
    echo $this->getSalario()."<br>";
}

public static function MostrarOperario($operario)
{
   return  $operario->Mostrar();
}

public function setAumentarSalario($porcentaje)
{
   $this->_salario=$this->_salario + $this->_salario*($porcentaje/100);
}




}


?>