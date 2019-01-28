<?php
include_once("../bd/AccesoDatos.php");

class Cliente
{

public $Id_cliente;
public $Nombre;
public $Apellido;
public $Usuario;
public $clave;
public $Id_rol;


public function Getid_cliente()
{
   return $this->Id_cliente;
}

public function SetNombre($valor)
{
    $this->Nombre=$valor;
}

public function GetNombre()
{
    return $this->Nombre;
}

public function SetApellido($valor)
{
    $this->Apellido=$valor;
}

public function GetApellido()
{
    return $this->Apellido;
}

public function SetUsuario($valor)
{
    $this->Usuario=$valor;
}

public function GetUsuario()
{
    return $this->Usuario;
}

public function SetClave($valor)
{
    $this->Clave=$valor;
}

public function GetClave()
{
    return $this->Clave;
}

public function SetId_rol($valor)
{
    $this->Id_rol=$valor;
}

public function GetId_rol()
{
    return $this->Id_rol;
}


public function __construct()
{

}

public static function TraerTodosLosClientes()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from clientes");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"cliente");
}

public static function InsertarElCliente($cliente)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO clientes (Nombre,Apellido,Usuario,Clave,Id_rol)
    VALUES('$cliente->Nombre','$cliente->Apellido','$cliente->Usuario',MD5('$cliente->clave'),'$cliente->Id_rol')");
    return $consulta->execute();
}

public static function VerificarCliente($Usuario,$clave)
{
    $retorno = false;
    $ArrayClientes = Cliente::TraerTodosLosClientes();
    for($i=0; $i<count($ArrayClientes); $i++)
    {           
		if($ArrayClientes[$i]->Usuario == $Usuario && $ArrayClientes[$i]->Clave == $clave)
		{
			$retorno=true;
		}
    }
	return $retorno;
}

public static function TraerElClientePorUsuario($Usuario)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from clientes where Usuario = '$Usuario' ");
    $consulta->execute();
    return $consulta->fetchObject('cliente');
}

public static function InsertarCalifiacion($idEmpleado, $calificacion)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO calificaciones (id_empleado,calificacion)
    VALUES ('$idEmpleado', '$calificacion') ");
    return $consulta->execute();
}

}

?>