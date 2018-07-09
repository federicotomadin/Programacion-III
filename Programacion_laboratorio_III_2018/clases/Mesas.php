<?php
include_once("../bd/AccesoDatos.php");


class Mesas
{
public $Id_mesa;
public $cantidadSillas;
public $Id_zona_mesa;
public $CodigoMesa;



public static function TraerMesas()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from mesas");
    $consulta->execute();
    return $consulta->etchAll(PDO::FETCH_CLASS,"mesas");
}



}