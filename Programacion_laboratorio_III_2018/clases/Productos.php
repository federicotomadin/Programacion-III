<?php
include_once("../bd/AccesoDatos.php");


class Productos
{
public $IdProducto;
public $Nombre;
public $Descripcion;
public $Precio;
public $Id_rol;
public $habilitado;


public static function TraerProductoPorNombre($Nombre)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from productos WHERE Nombre = '$Nombre'");
    $consulta->execute();
    return $consulta->fetchObject("productos");
}



?>