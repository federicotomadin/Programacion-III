<?php
include_once("../bd/AccesoDatos.php");


class ZonasMesas
{
public $Id_zonaMesa;
public $Descripcion;

public static function TraerZonaMesas()
{
   $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
   $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from zonas_mesas");
   $consulta->execute();
   return $consulta->fetchAll(PDO::FETCH_CLASS,"zonas_mesas");
}




?>