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
public $Importe;
public $foto;


public function SetId_pedido($valor)
{
    $this->Id_pedido=$valor;
}

public function GetId_pedido()
{
    return $this->Id_pedido;
}

public function SetTiempo_ingreso($valor)
{
    $this->Tiempo_ingreso=$valor;
}

public function GetTiempo_ingreso()
{
    return $this->$Tiempo_ingreso;
}

public function SetTiempo_estimado($valor)
{
    $this->Tiempo_estimado=$valor;
}

public function GetTiempo_estimado()
{
    return $this->Tiempo_estimado;
}

public function SetTiempo_llegadaMesa($valor)
{
    $this->Tiempo_llegadaMesa=$valor;
}

public function GetTiempo_llegadaMesa()
{
    return $this->Tiempo_llegadaMesa;
}

public function SetId_mesa($valor)
{
    $this->Id_mesa=$valor;
}

public function GetId_mesa()
{
    return $this->Id_mesa;
}

public function SetId_estadoCuenta($valor)
{
    $this->Id_estadoCuenta=$valor;
}

public function GetId_estadoCuenta()
{
    return $this->Id_estadoCuenta;
}

public function SetId_empleado($valor)
{
    $this->Id_empleado=$valor;
}

public function GetId_empleado()
{
    return $this->Id_empleado;
}

public function SetCodigo($valor)
{
    $this->codigo=$valor;
}

public function GetCodigo()
{
    return $this->codigo;
}

public function SetId_estadoPedido($valor)
{
    $this->Id_estadoPedido=$valor;
}

public function GetId_estadoPedido()
{
    return $this->Id_estadoPedido;
}

public function SetImporte($valor)
{
    $this->Importe=$valor;
}

public function GetImporte()
{
    return $this->Importe;
}

public function SetFoto($valor)
{
    $this->foto=$valor;
}

public function GetFoto()
{
    return $this->foto;
}


public function __construct()
{

}


public static function InsertarElPedido($pedido)
{ 
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO pedidos(Tiempo_ingreso,Tiempo_estimado,Tiempo_llegadaMesa,Id_mesa,Id_estadoCuenta,Id_empleado,codigo,Id_estadoPedido,Importe,foto)
VALUES('$pedido->Tiempo_ingreso', '$pedido->Tiempo_estimado','$pedido->Tiempo_llegadaMesa',
'$pedido->Id_mesa','$pedido->Id_estadoCuenta','$pedido->Id_empleado','$pedido->Codigo','$pedido->Id_estadoPedido','$pedido->Importe','$pedido->foto')");	
return $consulta->execute();
}


public static function TraerElPedido($IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pedidos WHERE Id_pedido = '$IdPedido'");
    $consulta->execute();
    return $consulta->fetchObject('pedidos');
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
    Tiempo_llegadaMesa = '$pedido->Tiempo_llegadaMesa'
    ,Id_mesa = '$pedido->Id_mesa',Id_estadoCuenta = '$pedido->Id_estadoCuenta'
    ,Id_empleado = '$pedido->Id_empleado',codigo = '$pedido->Codigo'
    ,Id_estadoPedido = '$pedido->Id_estadoPedido',Importe='$pedido->Importe', foto='$pedido->foto' where Id_pedido = '$pedido->Id_pedido' ");
    return $consulta->execute();
}

public static function TraerCantidadMesas($IdMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT  COUNT(*) as Cantidad from pedidos where Id_mesa='$IdMesa'");
    $consulta->execute();    
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


public static function TraerTotalFacturado($Id_mesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT pedidos.Id_mesa as Mesa, SUM(lista_pedidos.precio) as Importe  from pedidos 
    inner join lista_pedidos on lista_pedidos.Id_pedido=pedidos.Id_pedido where pedidos.Id_mesa='$Id_mesa'");
    $consulta->execute();    
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerTiempoFaltante($Codigo,$IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT Tiempo_ingreso, Tiempo_estimado  from pedidos where Id_pedido='$IdPedido' and codigo='$Codigo'");
    $consulta->execute();    
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function VerPedidosPendientes($IdEmpleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pedidos where Id_empleado='$IdEmpleado' and Id_estadoPedido=1");
    $consulta->execute();    
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function CerrarMesa($idPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedidos set Id_estadoCuenta=4 where Id_pedido='$idPedido'");
    $consulta->execute();    
}

public static function CambiarEstadoMesa($idPedido,$estado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedidos set Id_estadoCuenta='$estado' where Id_pedido='$idPedido'");
    $consulta->execute();    
}

public static function TraerElUltimoAgregado()
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();    
    $consulta = $objetoAcceso->RetornarConsulta("SELECT Id_pedido from pedidos order by Id_pedido DESC limit 1");
    $consulta->execute();
    $idPedido = $consulta->fetchColumn(0);
    return $idPedido;
}














}

?>