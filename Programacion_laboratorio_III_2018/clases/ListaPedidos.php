<?php
include_once("../bd/AccesoDatos.php");


class ListaPedidos
{
public $Id_pedido;
public $Id_producto;
public $Cantidad;


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

public function SetCantidad($valor)
{
    $this->$Cantidad=$valor;
}

public function GetCantidad()
{
    return $this->$Cantidad;
}

public function contruct__()
{

}

public static function InsertarListaPedido($pedido)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO lista_pedidos(Id_pedido,Id_producto,Cantidad)
VALUES('$pedido->Id_pedido', '$pedido->Id_producto','$pedido->Cantidad)");		
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
    Cantidad = '$pedido->Cantidad' where Id_pedido = '$pedido->Id_pedido' ");
    return $consulta->execute();
}




}