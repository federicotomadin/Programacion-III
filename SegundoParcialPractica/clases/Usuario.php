<?php
class Usuario
{
	private $id;
 	private $email;
    private $clave;
      
    public function GetId()
    {
        return $this->id;
    }
    
    public function SetId($valor)
    {
        $this->id = $valor;
    }
    
    
    public function GetEmail()
    {
        return $this->email;
    }
    
    public function SetEmail($valor)
    {
        $this->email = $valor;
    }

    public function GetClave()
    {
        return $this->clave;
    }
    
    public function SetClave($valor)
    {
        $this->clave = $valor;
    }



  	public static function TraerUsuarios()
      {
    	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario");
        $consulta->execute();
       // $usuarioBuscado= $consulta->fetchObject('Usuario');
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
       // return $usuarioBuscado;	

      }
    } 

    ?>