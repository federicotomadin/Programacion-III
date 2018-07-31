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


public static function TraerTodosLosProductos()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from productos");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
}



?>