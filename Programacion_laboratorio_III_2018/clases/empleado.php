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
public $habilitado;


public function Getid_empleado()
{
   return $this->id_empleado;
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

public function SetSueldo($valor)
{
    $this->Sueldo=$valor;
}

public function GetSueldo()
{
    return $this->Sueldo;
}

public function SetHabilitado($valor)
{
    $this->habilitado=$valor;
}

public function GetHabilitado()
{
    return $this->habilitado;
}

public function SetFoto($valor)
{
    $this->foto=$valor;
}

public function GetFoto()
{
    return $this->foto;
}

public function __construct()
{

}


public static function TraerTodosLosEmpleados()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from empleados");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,'empleado');
}

public static function TraerElEmpleadoPorUsuario($Usuario)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from empleados where Usuario = '$Usuario' ");
    $consulta->execute();
    return $consulta->fetchObject('empleado');
}

public static function TraerElEmpleado($Id_empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from empleados where id_empleado = '$Id_empleado'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function InsertarElEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO empleados (Nombre,Apellido,Usuario,Clave,Id_rol,Sueldo,habilitado)".
    "VALUES('$empleado->Nombre','$empleado->Apellido','$empleado->Usuario','$empleado->Clave','$empleado->Id_rol','$empleado->Sueldo','$empleado->habilitado')");
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
    Clave = '$empleado->Clave', Sueldo =  '$empleado->Sueldo', habilitado = '$empleado->habilitado' where id_empleado = '$empleado->id_empleado'");
    return $consulta->execute();
}

public static function SuspenderEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleados set habilitado = 0  where id_empleado = '$empleado->id_empleado'");
    return $consulta->execute();
}

public static function HabilitarEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleados set habilitado = 1  where id_empleado = '$empleado->id_empleado'");
    return $consulta->execute();
}


public static function VerificarEmpleado($Usuario,$clave)
{
    $retorno = false;
    $ArrayEmpleados = Empleado::TraerTodosLosEmpleados();
    for($i=0; $i<count($ArrayEmpleados); $i++)
    {           
		if($ArrayEmpleados[$i]->Usuario == $Usuario && $ArrayEmpleados[$i]->Clave == $clave)
		{
			$retorno=true;
		}
    }
	return $retorno;
}

public static function TraerFechasDeSesionesPorIdEmpleado($IdEmpleado)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT sesion.FechaIngreso AS fechaIngreso, sesion.FechaSalida AS FechaSalida FROM sesion WHERE sesion.IdEmpleado = '$IdEmpleado'");
$consulta->execute();
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerOperacionesEntradaPorIdEmpleado($id_empleado)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT empleados.Usuario as Usuario , operaciones.FechaOperacion as FechaOperacion FROM empleados 
INNER JOIN operaciones ON empleados.id_empleado=operaciones.Id_empleado WHERE operaciones.Id_empleado = '$id_empleado' group by '$id_empleado'");
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
    $consulta = $objetoAcceso->RetornarConsulta("SELECT id_empleado from empleados order by id_empleado DESC limit 1");
    $consulta->execute();
    $idEmpleado = $consulta->fetchColumn(0);
    return $idEmpleado;
}

public static function TraerDatosParaExportar()
{
$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAcceso->RetornarConsulta("SELECT empleados.id_empleado as IdEmpleado, empleados.Usuario as Usuario, sesion.FechaIngreso, empleados.habilitado from empleados
inner join sesion on empleados.id_empleado=sesion.IdEmpleado 
inner join operaciones on empleados.id_empleado=operaciones.Id_empleado group by empleados.id_empleado");
$consulta->execute();
return $consulta->fetchAll(PDO::FETCH_ASSOC);

}







}

?>