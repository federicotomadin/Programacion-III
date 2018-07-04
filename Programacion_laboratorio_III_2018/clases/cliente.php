<?php
include_once("../bd/AccesoDatos.php");


class Cliente
{
public $Id_cliente;
public $Nombre;
public $Apellido;
public $Fecha_ingreso;
public $Fecha_egreso;
public $CantidadPersonas;
public $Id_mesa;
public $id_empleado;
public $Id_estadoCuenta;


public function SetId_cliente($valor)
{
    $this->$Id_cliente=$valor;
}

public function GetId_cliente()
{
    return $this->$Id_cliente;
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

public function SetCantidadPersonas($valor)
{
    $this->$CantidadPersonas=$valor;
}

public function GetCantidadPersonas()
{
    return $this->$CantidadPersonas;
}

public function SetId_mesa($valor)
{
    $this->$Id_mesa=$valor;
}

public function GetId_mesa()
{
    return $this->$Id_mesa;
}

public function SetId_empleado($valor)
{
    $this->$Id_empleado=$valor;
}

public function GetId_empleado()
{
    return $this->$Id_empleado;
}

public function SetId_estadoCuenta($valor)
{
    $this->$Id_estadoCuenta=$valor;
}

public function GetId_estadoCuenta()
{
    return $this->$Id_estadoCuenta;
}

public function contruct__()
{

}


public static function InsertarElCliente($cliente)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO cliente (Nombre,Apellido,Fecha_ingreso,Fecha_egreso,CantidadPersonas,Id_mesa,id_empleado,Id_estadoCuenta)
VALUES('$cliente->Nombre', '$cliente->Apellido','$cliente->Fecha_ingreso','$cliente->Fecha_egreso'
,'$cliente->CantidadPersonas','$cliente->Id_mesa','$cliente->id_empleado','$cliente->Id_estadoCuenta')");		
return $consulta->execute();

}

public static function TraerTodosLosClientes()
{
   $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
   $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM `clientes`");
   $consulta->execute();
   return $consulta->fetchAll(PDO::FETCH_CLASS,"clientes");
}


public static function TraerElCliente($idCliente)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from auto WHERE Id_cliente = '$idCliente'");
    $consulta->execute();
    return $consulta->fetchObject("cliente");
}

public static function BorrarElCliente($idCliente)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("DELETE from auto WHERE Id_cliente = '$idCliente'");
    return $consulta->execute();
}

public static function ModificarElCliente($cliente)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE auto set Nombre = '$cliente->Nombre',Apellido = '$cliente->Apellido', 
    Fecha_ingreso = '$cliente->Fecha_ingreso',Fecha_egreso = '$cliente->Fecha_egreso'
    ,CantidadPersonas = '$cliente->CentidadPersonas',Id_mesa = '$cliente->Id_mesa'
    ,id_empleado = '$cliente->id_empleado',Id_estadoCuenta = '$cliente->Id_estadoCuenta'where Id_cliente = '$cliente->Id_cliente' ");
    return $consulta->execute();
}


}




?>