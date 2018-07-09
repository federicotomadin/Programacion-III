<?php
include_once("../bd/AccesoDatos.php");


class EstadoPedidos
{
public $Id_estadoPedido;
public $Descripcion;


public static function TraerEstadoPedidos()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from estadopedidos");
    $consulta->execute();
    return $consulta->etchAll(PDO::FETCH_CLASS,"estadopedidos");
}

}

?>
