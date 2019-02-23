<?php
include_once("../bd/AccesoDatos.php");


class Mesas
{
public $Id_mesa;
public $cantidadSillas;
public $Id_zona_mesa;
public $CodigoMesa;
public $EstadoMesa;



public static function TraerMesas()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from mesas");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerTodasLasMesas()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from mesas");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"mesas");
}

public static function CambiarEstadoMesaEsperandoAtencion($CodigoMesa)
{ 

    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas set EstadoMesa = 'EsperandoAtencion' where CodigoMesa = '$CodigoMesa'");
    return $consulta->execute();
}

public static function CambiarEstadoMesaOcupada($CodigoMesa)
{ 
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas  set EstadoMesa = 'Ocupada' where CodigoMesa = '$CodigoMesa'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"mesas");
}

public static function CambiarEstadoMesaLibre($CodigoMesa)
{ 
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas  set EstadoMesa = 'Cerrada' where CodigoMesa = '$CodigoMesa'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"mesas");
}

public static function CambiarEstadoMesaEsperandoPedido($CodigoMesa)
{ 
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas set EstadoMesa = 'EsperandoPedido' where CodigoMesa = '$CodigoMesa'");
   $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"mesas");
}

public static function TraerLasMesasLibres()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from mesas where EstadoMesa= 'Libre'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"mesas");
}

public static function TraerLasMesasEsperandoAtencion()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from mesas where EstadoMesa = 'EsperandoAtencion'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"mesas");
}

public static function TraerLasMesasEsperandoPedido()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from mesas where EstadoMesa = 'EsperandoPedido'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"mesas");
}

public static function TraerLasMesasOcupadas()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from mesas where EstadoMesa= 'Ocupadas'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"mesas");
}









}