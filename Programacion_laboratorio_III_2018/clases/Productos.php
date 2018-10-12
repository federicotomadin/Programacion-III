<?php
include_once("../bd/AccesoDatos.php");


class Productos
{
public $id_producto;
public $Nombre;
public $Descripcion;
public $Precio;
public $id_rol;



public static function TraerTodosLosProductos()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from productos");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"productos");
}


public static function TraerPrecio($IdProducto)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT Precio from productos where id_producto='$IdProducto'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerIdRol($IdProducto)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id_rol from productos where id_producto='$IdProducto'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerProducto($IdProducto)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT Nombre from productos where id_producto='$IdProducto'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


}



?>