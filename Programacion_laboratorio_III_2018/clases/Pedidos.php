<?php
include_once("../bd/AccesoDatos.php");


class Pedidos
{
public $Id_pedido;
public $Tiempo_ingreso;
public $Tiempo_estimado;
public $Tiempo_llegadaMesa;
public $Id_cliente;
public $Id_mesa;
public $Id_estadoCuenta;
public $Id_empleado;
public $codigo;
public $Id_estadoPedido;


public function SetId_pedido($valor)
{
    $this->$Id_pedido=$valor;
}

public function GetId_pedido()
{
    return $this->$Id_pedido;
}

public function SetTiempo_ingreso($valor)
{
    $this->$Tiempo_ingreso=$valor;
}

public function GetTiempo_ingreso()
{
    return $this->$Tiempo_ingreso;
}

public function SetTiempo_estimado($valor)
{
    $this->$Tiempo_estimado=$valor;
}

public function GetTiempo_estimado()
{
    return $this->$Tiempo_estimado;
}

public function SetTiempo_llegadaMesa($valor)
{
    $this->$Tiempo_llegadaMesa=$valor;
}

public function GetTiempo_llegadaMesa()
{
    return $this->$Tiempo_llegadaMesa;
}

public function SetId_cliente($valor)
{
    $this->$Id_cliente=$valor;
}

public function GetId_cliente()
{
    return $this->$Id_cliente;
}

public function SetId_mesa($valor)
{
    $this->$Id_mesa=$valor;
}

public function GetId_mesa()
{
    return $this->$Id_mesa;
}

public function SetId_estadoCuenta($valor)
{
    $this->$Id_estadoCuenta=$valor;
}

public function GetId_estadoCuenta()
{
    return $this->$Id_estadoCuenta;
}

public function SetId_empleado($valor)
{
    $this->$Id_empleado=$valor;
}

public function GetId_empleado()
{
    return $this->$Id_empleado;
}

public function SetCodigo($valor)
{
    $this->$Codigo=$valor;
}

public function GetCodigo()
{
    return $this->$Codigo;
}

public function SetId_estadoPedido($valor)
{
    $this->$Id_estadoPedido=$valor;
}

public function GetId_estadoPedido()
{
    return $this->$Id_estadoPedido;
}


public function __construct()
{

}


public static function InsertarElPedido($pedido)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO pedido(Id_pedido,Tiempo_ingreso,Tiempo_estimado,Tiempo_llegadaMesa,Id_pedido,Id_mesa,Id_estadoCuenta,Id_empleado,codigo,Id_estadoPedido)
VALUES('$pedido->Tiempo_ingreso', '$pedido->Tiempo_estimado','$pedido->Tiempo_llegadaMesa','$pedido->Id_pedido'
,'$pedido->Id_mesa','$pedido->Id_estadoCuenta','$pedido->Id_empleado','$pedido->codigo','$pedido->Id_estadoPedido')");		
return $consulta->execute();

}


public static function TraerPedidos($IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pedidos WHERE Id_pedido = '$IdPedido'");
    $consulta->execute();
    return $consulta->fetchObject("pedidos");
}

public static function TraerTodosPedidos()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pedidos");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function BorrarElPedido($IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("DELETE from pedidos WHERE Id_pedido = '$IdPedido'");
    return $consulta->execute();
}

public static function ModificarPedido($pedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedidos set Tiempo_ingreso = '$pedido->Tiempo_ingreso',Tiempo_estimado = '$pedido->Tiempo_estimado', 
    Tiempo_llegadaMesa = '$pedido->Tiempo_llegadaMesa',Id_cliente = '$pedido->Id_cliente'
    ,Id_mesa = '$pedido->Id_mesa',Id_estadoCuenta = '$pedido->Id_estadoCuenta'
    ,id_empleado = '$pedido->id_empleado',codigo = '$pedido->codigo'
    ,Id_estadoPedido = '$pedido->Id_estadoPedido' where Id_pedido = '$pedido->Id_pedido' ");
    return $consulta->execute();
}


}

?>