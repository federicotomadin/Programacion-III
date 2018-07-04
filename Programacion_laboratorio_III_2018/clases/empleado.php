<?php

include_once("../bd/AccesoDatos.php");


class Empleado
{

public $id_empleado;
public $Nombre;
public $Apellido;
public $Usuario;
public $Clave;
public $Id_rol;
public $Fecha_ingreso;
public $Fecha_egreso;
public $Sueldo;
public $habilitado;


public function Getid_empleado()
{
   return $this->$id_empleado;
}

public function SetNombre($valor)
{
    $this->$Nombre=$valor;
}

public function GetNombre()
{
    return $this->$Nombre;
}

public function SetApellido($valor)
{
    $this->$Apellido=$valor;
}

public function GetApellido()
{
    return $this->$Apellido;
}

public function SetUsuario($valor)
{
    $this->$Usuario=$valor;
}

public function GetUsuario()
{
    return $this->$Usuario;
}

public function SetClave($valor)
{
    $this->$Clave=$valor;
}

public function GetClave()
{
    return $this->$Clave;
}

public function SetId_ro($valor)
{
    $this->$Id_rol=$valor;
}

public function GetId_rol()
{
    return $this->$Id_rol;
}

public function SetId_ro($valor)
{
    $this->$Id_rol=$valor;
}

public function GetId_rol()
{
    return $this->$Id_rol;
}

public function SetFecha_ingreso($valor)
{
    $this->$Fecha_ingreso=$valor;
}

public function GetFecha_ingreso()
{
    return $this->$Fecha_ingreso;
}

public function SetFecha_egreso($valor)
{
    $this->$Fecha_egreso=$valor;
}

public function GetFecha_egreso()
{
    return $this->$Fecha_egreso;
}

public function SetSueldo($valor)
{
    $this->$Sueldo=$valor;
}

public function GetSueldo()
{
    return $this->$Sueldo;
}

public function Sethabilitado($valor)
{
    $this->$habilitado=$valor;
}

public function Gethabilitado()
{
    return $this->$habilitado;
}

public function construct__()
{

}


public static function TraerTodosLosEmpleados()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM empleado");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,'empleado');
}

public static function TraerElEmpleado($id_empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from empleado where id = '$idEmpleado' ");
    $consulta->execute();
    return $consulta->fetchObject('empleado');
}

public static function InsertarElEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO empleado (Nombre,Apellido,Usuario,Clave,Id_rol,Fecha_ingreso, Fecha_egreso,Sueldo,habilitado)".
    "VALUES('$empleado->Nombre','$empleado->Apellido','$empleado->Usuario','$empleado->Clave','$empleado->Id_rol','$empleado->Fecha_ingreso','$empleado->Fecha_egreso','$empleado->Sueldo','$empleado->habilitado')");
    return $consulta->execute();
}

public static function BorrarElEmpleado($id_empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("DELETE from empleado where id_empleado = '$id_empleado' ");
    return $consulta->execute();
}

public static function ModificarElEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleado set Nombre = '$empleado->Nombre', Apellido = '$empleado->Apellido', Usuario = '$empleado->Usuario',
    Clave = '$empleado->Clave', Fecha_ingreso = '$empleado->Fecha_ingreso' , Fecha_egreso = '$empleado->Fecha_egreso', Sueldo =  '$empleado->Sueldo', habilitado = '$empleado->habilitado' where id_empleado = '$empleado->id_empleado'");
    return $consulta->execute();
}

public static function SuspenderEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleado set habilitado = 0  where id_empleado = '$empleado->id_empleado'");
    return $consulta->execute();
}


public static function VerificarEmpleado($Usuario,$clave)
{
	$retorno = false;
	$ArrayEmpleados = Empleado::TraerTodosLosEmpleados();
	foreach($ArrayEmpleados as $employee)
	{
		if($employee->GetUsuario() == $Usuario && $employee->GetClave() == $clave)
		{
			$retorno = true;
		}
	}
	return $retorno;
}

public static function TraerFechasDeSesionesPorIdEmpleado($id_empleado)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT sesion.FechaIngreso AS fechangreso, sesion.FechaSalida AS FechaSalida FROM sesion WHERE sesion.id_empleado = '$id_empleado'");
$consulta->execute();
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerOperacionesEntradaPorIdEmpleado($id_empleado)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT empleado.Usuario as Usuario , operaciones.FechaOperacion as FechaOperacion FROM empleados INNER JOIN operaciones ON empleados._id_empleado=operaciones.Id_empleado WHERE operacioens.Id_empleado = '$id_empleado'");
$consulta->execute();
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}





}

?>