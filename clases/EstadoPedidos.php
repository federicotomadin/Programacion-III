<?php
include_once("../bd/AccesoDatos.php");


class EstadoPedidos
{
public $Id_estadoPedido;
public $Descripcion;


public static function TraerEstadoPedidos($Id_estadoPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT Descripcion from estadopedidos where Id_estadoPedido='$Id_estadoPedido'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

}

?>
