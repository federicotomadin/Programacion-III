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
public $Sueldo;
public $Habilitado;
public $Foto;


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

public function SetId_rol($valor)
{
    $this->$Id_rol=$valor;
}

public function GetId_rol()
{
    return $this->$Id_rol;
}

public function SetSueldo($valor)
{
    $this->$Sueldo=$valor;
}

public function GetSueldo()
{
    return $this->$Sueldo;
}

public function SetHabilitado($valor)
{
    $this->$Habilitado=$valor;
}

public function GetHabilitado()
{
    return $this->$Habilitado;
}

public function SetFoto($valor)
{
    $this->$Foto=$valor;
}

public function GetFoto()
{
    return $this->$Foto;
}

public function construct__()
{

}


public static function TraerTodosLosEmpleados()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM empleados");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,'empleados');
}

public static function TraerElEmpleadoPorUsuario($Usuario)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from empleados where Usuario = '$Usuario' ");
    $consulta->execute();
    return $consulta->fetchObject('empleados');
}

public static function TraerElEmpleado($Id_empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from empleados where id_empleado = '$Id_empleado'");
    $consulta->execute();
    return $consulta->fetchObject('empleados');
}

public static function InsertarElEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO empleados (Nombre,Apellido,Usuario,Clave,Id_rol,Sueldo,habilitado,foto)".
    "VALUES('$empleado->Nombre','$empleado->Apellido','$empleado->Usuario','$empleado->Clave','$empleado->Id_rol','$empleado->Sueldo','$empleado->habilitado','$empleado->foto')");
    return $consulta->execute();
}

public static function BorrarElEmpleado($id_empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("DELETE from empleados where id_empleado = '$id_empleado' ");
    return $consulta->execute();
}

public static function ModificarElEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleados set Nombre = '$empleado->Nombre', Apellido = '$empleado->Apellido', Usuario = '$empleado->Usuario',
    Clave = '$empleado->Clave', Sueldo =  '$empleado->Sueldo', habilitado = '$empleado->habilitado', foto = '$empleado->foto' where id_empleado = '$empleado->id_empleado'");
    return $consulta->execute();
}

public static function SuspenderEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleados set habilitado = 0  where id_empleado = '$empleado->id_empleado'");
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
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT sesion.FechaIngreso AS fechaIngreso, sesion.FechaSalida AS FechaSalida FROM sesion WHERE sesion.id_empleado = '$id_empleado'");
$consulta->execute();
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerOperacionesEntradaPorIdEmpleado($id_empleado)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT empleado.Usuario as Usuario , operaciones.FechaOperacion as FechaOperacion FROM empleados 
INNER JOIN operaciones ON empleados.id_empleado=operaciones.Id_empleado WHERE operacioens.Id_empleado = '$id_empleado'");
$consulta->execute();
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerOperacionesPorSector($Id_rol)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT empleado.Id_rol as Rol , operaciones.FechaOperacion as FechaOperacion FROM empleados 
INNER JOIN operaciones ON empleados.Id_rol=operaciones.Id_rol WHERE operaciones.Id_rol = '$Id_rol'");
$consulta->execute();
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


public static function TraerUltimoIdAgregado()
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();    
    $consulta = $objetoAcceso->RetornarConsulta("SELECT id_empleado from empleados order by id_empelado DESC limit 1");
    $consulta->execute();
    $idEmpleado = $consulta->fetchColumn(0);
    return $idEmpleado;
}





}

?>