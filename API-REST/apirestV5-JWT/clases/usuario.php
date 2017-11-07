<?php
class usuario
{
	public $id;
 	public $nombre;
    public $clave;
      
    public function GetId()
    {
        return $this->id;
    }
    
    public function SetId($valor)
    {
        $this->id = $valor;
    }
    
    
    public function GetNombre()
    {
        return $this->nombre;
    }
    
    public function SetNombre($valor)
    {
        $this->nombre = $valor;
    }

    public function GetClave()
    {
        return $this->clave;
    }
    
    public function SetClave($valor)
    {
        $this->clave = $valor;
    }



  	public static function TraerUsuario()
      {
    	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario");
        $consulta->execute();
        $usuarioBuscado= $consulta->fetchObject('usuario');
        return $usuarioBuscado;				

      }
  
      




}

?>


      