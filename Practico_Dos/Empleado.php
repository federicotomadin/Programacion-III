<?php   

include_once "Persona.php";

class  Empleado extends Persona
{
    protected $_legajo;
    protected $_sueldo;
    protected $_pathFoto;

    function __Empleado($nombre,$apellido,$dni,$sexo,$legajo,$sueldo)
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
    
    public function getPathFoto()
    {
        return $this->_pathFoto;
    }

    public function setPathFoto($pathFoto)
    {
        $this->_pathFoto = $pathFoto;
    }

    public  function  Hablar($idioma)
    {

        echo "El Empleado habla: ".$idioma."<br>";

    }

   public function ToString()
   {
      return parent::ToString()." - "."Legajo: ".$this->getLegajo()." - "."Sueldo ".$this->getSueldo()."<br>";
   }

   function MostrarEmpleado()
   {
       return 'Apellido: '.$this->getApellido().' Imagen: '.$this->getPathFoto();
   }

   static function Archivar($empleado)
   {   
       $archivo = fopen('Archivos/EmpleadosImagen.txt',"a");
       fwrite($archivo,$empleado->MostrarEmpleado()."\r\n");         
       fclose($archivo);
   }




}



?>