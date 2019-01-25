<?php
include_once("../bd/AccesoDatos.php");


class EstadoCuentaPedidos
{
public $Id_estadoCuenta;
public $Descripcion;



public static function TraerCuentaPedidos($Id_estadoCuenta)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT Descripcion from estado_cuenta_pedidos where Id_estadoCuenta='$Id_estadoCuenta'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


}

?>