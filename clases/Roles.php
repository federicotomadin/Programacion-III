<?php
include_once("../bd/AccesoDatos.php");


class Roles
{
public $Id_rol;
public $descripcion;



public static function TraerRoles()
{
   $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
   $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from roles");
   $consulta->execute();
   return $consulta->fetchAll(PDO::FETCH_CLASS,'roles');
}


public static function TraerIdRol($descripcion)
{
   $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
   $consulta = $objetoAccesoDato->RetornarConsulta("SELECT Id_rol from roles where descripcion='$descripcion'");
   $consulta->execute();
   return $consulta->fetchAll(PDO::FETCH_ASSOC);

}

}

?>