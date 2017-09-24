<?php

 abstract class Persona
{
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_sexo;


    function __construct($nombre,$apellido,$dni,$sexo)
    {
        $this->_nombre=$nombre;
        $this->_apellido=$apellido;
        $this->_dni=$dni;
        $this->_sexo=$sexo;

    }

    function getNombre()
    {
        return $this->_nombre;
    }
    function getApellido()
    {
        return $this->_apellido;
    }
    function getDni()
    {
        return $this->_dni;
    }
    function getSexo()
    {
        return $this->_sexo;
    }

   abstract public function Hablar($idioma);


    public function ToString()
    {
     return  "Nombre: ".$this->getNombre()." - "."Apellido: ".$this->getApellido()." - "."Dni: ".$this->getDni()." - "."Sexo".$this->getSexo();
       
    }
}
?>