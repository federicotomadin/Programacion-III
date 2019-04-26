<?php
include_once("../bd/AccesoDatos.php");
include_once("Pedidos.php");


class ListaPedidos
{
public $Id_pedido;
public $Id_pedidoDetalle;
public $Id_producto;
public $Id_rol;
public $Id_estadoPedido;
public $CodigoMesa;
public $Tiempo_estimado;
public $Tiempo_esperandoEntrega;
public $Tiempo_llegadaMesa;
public $Cantidad;
public $Precio; 


public function SetId_pedido($valor)
{
    $this->Id_pedido=$valor;
}

public function GetId_pedido()
{
    return $this->Id_pedido;
}

public function SetId_pedidoDetalle($valor)
{
    $this->Id_pedidoDetalle=$valor;
}

public function GetId_pedidoDetalle()
{
    return $this->Id_pedidoDetalle;
}


public function SetId_producto($valor)
{
    $this->Id_producto=$valor;
}

public function GetId_producto()
{
    return $this->Id_producto;
}

public function SetPrecio($valor)
{
    $this->Precio=$valor;
}

public function GetPrecio()
{
    return $this->Precio;
}

public function SetCantidad($valor)
{
    $this->Cantidad=$valor;
}

public function GetCantidad()
{
    return $this->Cantidad;
}

public function SetId_rol($valor)
{
    $this->Id_rol=$valor;
}

public function GetId_rol()
{
    return $this->Id_rol;
}

public function SetId_estadoPedido($valor)
{
    $this->Id_estadoPedido=$valor;
}

public function GetId_estadoPedido()
{
    return $this->Id_estadoPedido;
}

public function SetCodigoMesa($valor)
{
    $this->CodigoMesa=$valor;
}

public function GetCodigoMesa()
{
    return $this->CodigoMesa;
}

public function SetTiempo_estimado($valor)
{
    $this->Tiempo_estimado=$valor;
}

public function GetTiempo_estimado()
{
    return $this->Tiempo_estimado;
}

public function SetTiempo_esperandoEntrega($valor)
{
    $this->Tiempo_esperandoEntrega=$valor;
}

public function GetTiempo_esperandoEntrega()
{
    return $this->Tiempo_esperandoEntrega;
}

public function SetTiempo_llegadaMesa($valor)
{
    $this->Tiempo_llegadaMesa=$valor;
}

public function GetTiempo_llegadaMesa()
{
    return $this->Tiempo_llegadaMesa;
}

public function __contruct()
{

}

public static function InsertarListaPedido($pedido)
{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO lista_pedidos(Id_pedido,Id_pedidoDetalle,Id_producto,Id_rol,Id_estadoPedido,CodigoMesa,Cantidad,Precio,Tiempo_estimado,Tiempo_esperandoEntrega,Tiempo_llegadaMesa)
VALUES('$pedido->Id_pedido','$pedido->Id_pedidoDetalle,'$pedido->Id_producto','$pedido->Id_rol','$pedido->Id_estadoPedido','$pedido->CodigoMesa','$pedido->Cantidad','$pedido->Precio')");		
return $consulta->execute();
}

public static function TraerPedidos($IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from lista_pedidos WHERE Id_pedido = '$IdPedido'");
    $consulta->execute();
    return $consulta->fetchObject("lista_pedidos");
}

public static function TraerTodosLosPedidos()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from lista_pedidos");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function TraerElPedidoDetallePorCodigoMesaCambiarEstado($CodigoMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from ListaPedidos 
    WHERE CodigoMesa = '$CodigoMesa'");
    $consulta->execute();
    return $consulta->fetchObject('pedidos');
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
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE lista_pedidos set Id_pedido = '$pedido->Id_pedido',Id_producto = '$pedido->Id_producto'
    ,$Precio = '$pedido->Precio' where Id_pedido = '$pedido->Id_pedido' ");
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

public static function BuscarMesa($CodigoMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from lista_pedidos WHERE CodigoMesa = '$CodigoMesa' and Id_pedido=0");
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

public static function BuscarPedidoCocina($CodigoMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM lista_pedidos
    where CodigoMesa='$CodigoMesa' and Id_rol=3 and Id_estadoPedido=4");
    $consulta->execute(); 
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


public static function VerPedidosPendientesPorRol($IdRol)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM lista_pedidos 
    where Id_rol='$IdRol'");
    $consulta->execute(); 
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function VerPedidosPendientesPorIdPedido($IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM lista_pedidos lp
    inner join pedidos ped on lp.Id_pedido = ped.Id_pedido
    where lp.Id_pedido='$IdPedido'");
    $consulta->execute(); 
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


public static function IntertarIdPedido($CodigoMesa,$IdPedido)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE lista_pedidos 
    set Id_pedido='$IdPedido'
    where CodigoMesa='$CodigoMesa'");
    return $consulta->execute(); 
}


public static function CambiarEstadoPedido($IdEstadoPedido,$IdRol,$CodigoMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE lista_pedidos 
    set Id_estadoPedido='$IdEstadoPedido'
    where CodigoMesa='$CodigoMesa' and Id_rol='$IdRol' and Id_pedido!=0");
    return $consulta->execute(); 
}

public static function TraerImportePedido($IdPedido,$CodigoMesa)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(Precio) as Importe FROM lista_pedidos 
    where Id_pedido='$IdPedido' and Id_estadoPedido=2 and CodigoMesa='$CodigoMesa'");
    $consulta->execute(); 
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

public static function CambiarEstadoEnPreparacion($IdPedido,$IdRol)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE lista_pedidos 
    set Id_estadoPedido=1
    where  Id_pedido='$IdPedido' and Id_rol = '$IdRol'");
    return $consulta->execute(); 
}

public static function CambiarEstadoListoParaServir($IdPedido,$IdRol)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE lista_pedidos 
    set Id_estadoPedido=2
    where  Id_pedido='$IdPedido' and Id_rol = '$IdRol'");
    return $consulta->execute(); 
}

public static function CambiarEstadoEsperandoEntrega($Id_pedido,$Id_pedidoDetalle,$IdRol)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE lista_pedidos 
    set Id_estadoPedido=6
    where  Id_pedido='$Id_pedido' and Id_pedidoDetalle = '$Id_pedidoDetalle' and Id_rol = '$IdRol'");
    return $consulta->execute(); 
}

public static function ActualizarTiempoEsperandoEntrega($Tiempo_esperandoEntrega,$IdPedido)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();    
    $consulta = $objetoAcceso->RetornarConsulta("UPDATE pedidos 
    set Tiempo_esperandoEntrega='$Tiempo_esperandoEntrega', Id_estadoPedido=2
    where Id_pedido='$IdPedido'");
    return $consulta->execute();
}

public static function ActualizarTiempoEstimado($Tiempo_estimado,$IdPedido)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();    
    $consulta = $objetoAcceso->RetornarConsulta("UPDATE pedidos 
    set Tiempo_estimado='$Tiempo_estimado', Id_estadoPedido=1
    where Id_pedido='$IdPedido'");
    return $consulta->execute();
}



}

?>