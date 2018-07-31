<?php
include_once("../bd/AccesoDatos.php");
include_once("Pedidos.php");


class ListaPedidos
{
public $Id_pedido;
public $Id_producto;
public $Precio; 


public function SetId_pedido($valor)
{
    $this->$Id_pedido=$valor;
}

public function GetId_pedido()
{
    return $this->$Id_pedido;
}

public function SetId_producto($valor)
{
    $this->$Id_producto=$valor;
}

public function GetId_producto()
{
    return $this->$Id_producto;
}


public function SetPrecio($valor)
{
    $this->Precio=$valor;
}

public function GetPrecio()
{
    return $this->Precio;
}

public function __contruct()
{

}

public static function InsertarListaPedido($pedido)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO lista_pedidos(Id_pedido,Id_producto,Precio)
VALUES('$pedido->Id_pedido', '$pedido->Id_producto','$pedido->Precio')");		
return $consulta->execute();

}

public static function TraerPedidos($IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from lista_pedidos WHERE Id_pedido = '$IdPedido'");
    $consulta->execute();
    return $consulta->fetchObject("lista_pedidos");
}

public static function BorrarElPedido($IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("DELETE from lista_pedidos WHERE Id_pedido = '$IdPedido'");
    return $consulta->execute();
}


public static function ModificarPedido($pedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE lista_pedidos set Id_pedido = '$pedido->Id_pedido',Id_producto = '$pedido->Id_producto', 
    Precio = '$pedido->Precio' where Id_pedido = '$pedido->Id_pedido' ");
    return $consulta->execute();
}


public static function TraerImporte($Id_pedido)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT pedidos.Tiempo_ingreso as TiempoInicio, pedidos.Tiempo_llegadaMesa as TiempoFin,  SUM(Precio) as importe FROM lista_pedidos
inner join pedidos  on pedidos.Id_pedido='$Id_pedido' where lista_pedidos.Id_pedido='$Id_pedido' order by pedidos.Id_pedido ");
$consulta->execute();
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerCantidadProducto($IdProducto)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT COUNT(*) from lista_pedidos WHERE Id_producto = '$IdProducto'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


public static function TraerElMaximoImporte()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT MAX() from lista_pedidos WHERE Id_producto = '$IdProducto'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}



}

?>