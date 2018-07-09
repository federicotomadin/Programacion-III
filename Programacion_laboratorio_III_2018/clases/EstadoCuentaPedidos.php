<?php
include_once("../bd/AccesoDatos.php");


class EstadoCuentaPedidos
{
public $Id_estadoCuenta;
public $Descripcion;



public static function TraerCuentaPedidos()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from estado_cuenta_pedidos'");
    $consulta->execute();
    return $consulta->etchAll(PDO::FETCH_CLASS,"estado_cuenta_pedidos");
}


}

?>