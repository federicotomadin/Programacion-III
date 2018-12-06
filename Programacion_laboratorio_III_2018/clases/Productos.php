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

public static function BorrarProducto($IdProducto)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("DELETE  from productos where id_producto='$IdProducto'");
    return $consulta->execute();
}

public static function TraerProducto($IdProducto)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT Nombre from productos where id_producto='$IdProducto'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerProductoPorId($IdProducto)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from productos where id_producto='$IdProducto'");
    $consulta->execute();
    return $consulta->fetchObject('productos');
}

public static function InsertarProducto($Producto)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO productos(Nombre, Descripcion, Precio, id_rol)
    VALUES('$Producto->Nombre','$Producto->Descripcion','$Producto->Precio','$Producto->id_rol')");
    return $consulta->execute();
}

public static function ModificarProducto($Producto)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();

    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE productos 
     set Nombre = '$Producto->Nombre', Descripcion = '$Producto->Descripcion',
     Precio = '$Producto->Precio'
    where id_producto='$Producto->id_producto'");
    return  $consulta->execute();
}


}



?>