<?php
include_once("../bd/AccesoDatos.php");
class Sesion
{
    public $IdSesion;
    public $IdEmpleado;
    public $FechaIngreso;
    public $FechaSalida;

    public function GetId()
    {
        return $this->IdSesion;
    }

    public function SetId($valor)
    {
        $this->IdSesion = $valor;
    }

     public function GetIdEmpleado()
    {
        return $this->IdEmpleado;
    }

    public function SetIdEmpleado($valor)
    {
        $this->IdEmpleado = $valor;
    }

    public function GetFechaIngreso()
    {
        return $this->FechaIngreso;
    }

    public function SetFechaIngreso($valor)
    {
        $this->FechaIngreso = $valor;
    }
    

      public function GetFechaSalida()
    {
        return $this->FechaSalida;
    }

    public function SetFechaSalida($valor)
    {
        $this->FechaSalida = $valor;
    }

    public function __construct()
    {

    }     

    public static function TraerTodasLasSesiones()
    {
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from sesion");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,'sesion');
    }

    public static function InsertarSesionInicio($sesion)
    {
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO sesion(IdEmpleado,FechaIngreso,FechaSalida)"."VALUES('$sesion->IdEmpleado','$sesion->FechaIngreso',NULL)");
        $consulta->execute();   
    }

    public static function TraerSesionSinSalida($IdEmpleado)
    {
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from sesion where IdEmpleado = '$IdEmpleado' && fechaSalida IS NULL ");
        $consulta->execute();
        return $consulta->fetchObject('sesion');
    }

    public static function ModificarSesionSalida($sesion)
    {
       $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
       $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE sesion set fechaSalida = '$sesion->FechaSalida' where IdSesion = '$sesion->IdSesion'");
       $consulta->execute();   
    }

    public static function TraerUltimoIdAgregado()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("SELECT idSesion from sesion order by idSesion DESC limit 1");
	    $consulta->execute();
	    $idSesion = $consulta->fetchColumn(0);
	    return $idSesion;
	}

    public static function TraerSesionPorId($IdSesion)
    {
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from sesion where IdSesion = '$IdSesion'");
        $consulta->execute();
        return $consulta->fetchObject("sesion");
    }
}
?>