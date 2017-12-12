<?php
include_once "AccesoDatos.php";

class Venta
{
  public $id;
  public $nombreCliente;
  public $fecha;
  public $precio;
  public $idBicicleta;

  public function __construct()
  {

  }
  

  
  public static function InsertarLaVentaParametros($venta)
	{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO venta (nombrecliente,fecha,precio,idBicicleta)" . "VALUES('$venta->nombreCliente', '$venta->fecha','$venta->precio','$venta->idBicicleta')");
    $consulta->execute();		
    return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}


}
?>