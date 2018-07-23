<?php
include_once("../bd/AccesoDatos.php");


class Operaciones
{
public $IdOperacion;
public $FechaOperacion;
public $Id_rol;
public $Id_empleado;


public function SetIdOperacion($valor)
{
    $this->$IdOperacion=$valor;
}

public function GetIdOperacion()
{
    return $this->$IdOperacion;
}

public function SetFechaOperacion($valor)
{
    $this->$FechaOperacion=$valor;
}

public function GetFechaOperacion()
{
    return $this->$FechaOperacion;
}

public function SetId_rol($valor)
{
    $this->$Id_rol=$valor;
}

public function GetId_rol()
{
    return $this->$Id_rol;
}

public function SetId_empleado($valor)
{
    $this->$Id_empleado=$valor;
}

public function GetId_empleado()
{
    return $this->$Id_empleado;
}

public function construct__()
{

}

public static function InsertarOperacion($operacion)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO operaciones(FechaOperacion,Id_rol,Id_empleado)
VALUES('$operacion->FechaOperacion', '$operacion->Id_rol','$operacion->Id_empleado')");		
return $consulta->execute();

}


public static function TraerOperacionesPorSectorYEmpleado($IdRol,$IdEmpleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT COUNT(*) from operaciones WHERE Id_rol = '$IdRol' && Id_empleado='$IdEmpleado'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerOperacionesPorSector($IdRol)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT COUNT(*) from operaciones WHERE Id_rol = '$IdRol'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerOperacionesPorEmpleado($IdEmpleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT COUNT(*) as CantidadOperaciones from operaciones WHERE Id_empleado = '$IdEmpleado'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}




}

?>