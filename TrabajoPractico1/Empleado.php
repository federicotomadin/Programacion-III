<?php   

include_once "Persona.php";

class  Empleado extends Persona
{
    protected $_legajo;
    protected $_sueldo;

    function __construct($nombre,$apellido,$dni,$sexo,$legajo,$sueldo)
    {
        parent::__construct($nombre,$apellido,$dni,$sexo);

      $this->_legajo=$legajo;
      $this->_sueldo=$sueldo;
       
    }


    public function getLegajo()
    {
        return $this->_legajo;
    }

    public function getSueldo()
    {
        return $this->_sueldo;
    }

    public  function  Hablar($idioma)
    {

        echo "El Empleado habla: ".$idioma."<br>";

    }

   public function ToString()
   {
       echo parent::ToString()." - "."Legajo: ".$this->getLegajo()." - "."Sueldo ".$this->getSueldo()."<br>";
   }




}



?>