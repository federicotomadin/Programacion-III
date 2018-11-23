<?php
include_once("../bd/AccesoDatos.php");


class Pedidos
{
public $Id_pedido;
public $Tiempo_ingreso;
public $Tiempo_estimado;
public $Tiempo_llegadaMesa;
public $EstadoCuenta;
public $Usuario;
public $CodigoMesa;
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
    return $this->Tiempo_ingreso;
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


public function SetEstadoCuenta($valor)
{
    $this->EstadoCuenta=$valor;
}

public function GetEstadoCuenta()
{
    return $this->EstadoCuenta;
}

public function SetUsuario($valor)
{
    $this->Usuario=$valor;
}

public function GetUsuario()
{
    return $this->Usuario;
}

public function SetCodigoMesa($valor)
{
    $this->CodigoMesa=$valor;
}

public function GetCodigoMesa()
{
    return $this->CodigoMesa;
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
$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO pedidos(Tiempo_ingreso,Tiempo_estimado,Tiempo_llegadaMesa,EstadoCuenta,Usuario,CodigoMesa,Importe,foto)
VALUES('$pedido->Tiempo_ingreso','$pedido->Tiempo_estimado','$pedido->Tiempo_llegadaMesa',
'$pedido->EstadoCuenta','$pedido->Usuario','$pedido->CodigoMesa','$pedido->Importe','$pedido->foto')");
return $consulta->execute();
}


public static function TraerElPedido($IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pedidos WHERE Id_pedido = '$IdPedido'");
    $consulta->execute();
    return $consulta->fetchObject('pedidos');
}

public static function TraerElPedidoPorCodigoMesa($CodigoMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pedidos 
    WHERE CodigoMesa = '$CodigoMesa' and EstadoCuenta ='Esperando Cierre'");
    $consulta->execute();
    return $consulta->fetchObject('pedidos');
}

public static function TraerTodosPedidos()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pedidos");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"pedidos");
}


public static function TraerTodosPedidosQueSeEntregaron()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pedidos where EstadoCuenta='Cerrada'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"pedidos");
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

public static function TraerCantidadMesas($CodigoMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT  COUNT(*) as Cantidad from pedidos where CodigoMesa='$CodigoMesa'");
    $consulta->execute();    
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerTotalFacturado($CodigoMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT CodigoMesa as Mesa, SUM(Importe) as Importe  from pedidos
    where CodigoMesa='$CodigoMesa'");
    $consulta->execute();    
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerTiempoFaltante($CodigoMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT Tiempo_ingreso, Tiempo_estimado  from pedidos where CodigoMesa='$CodigoMesa' and EstadoCuenta='En Preparacion'");
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


public static function CambiarEstadoMesa($idPedido,$estado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedidos set Id_estadoCuenta='$estado' where Id_pedido='$idPedido'");
    return $consulta->execute();    
}

public static function TraerElUltimoAgregado()
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();    
    $consulta = $objetoAcceso->RetornarConsulta("SELECT Id_pedido from pedidos order by Id_pedido DESC limit 1");
    $consulta->execute();
    $idPedido = $consulta->fetchColumn(0);
    return $idPedido;
}


public static function CerrarMesa($CodigoMesa,$Importe)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();    
    $consulta = $objetoAcceso->RetornarConsulta("UPDATE pedidos 
    set Importe='$Importe', EstadoCuenta = 'Cerrada'
    where CodigoMesa='$CodigoMesa' and EstadoCuenta='Esperando Cierre'");
    return $consulta->execute();
}

public static function ActualizarTiempoLLegadaMesa($TiempoLlegadaMesa,$CodigoMesa)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();    
    $consulta = $objetoAcceso->RetornarConsulta("UPDATE pedidos 
    set Tiempo_llegadaMesa='$TiempoLlegadaMesa'
    where CodigoMesa='$CodigoMesa'");
    return $consulta->execute();
}
}

?>