<?php
include_once("../bd/AccesoDatos.php");

class Venta
{
  public $id;
  public $nombrecliente;
  public $fecha;
  public $precio;
  public $idBicicleta;

  public function __construct()
  {

  }
  


  public function GetId()
  {
  return $this->id;
  }

  public function SetId($valor)
  {
   $this->id = $valor;
  }

  public function GetNombreCliente()
  {
      return $this->nombrecliente;
  }

  public function SetNombreCliente($valor)
  {
      $this->nombrecliente = $valor;
  }

  public function GetFecha()
  {
      return $this->fecha;
  }

  public function SetFecha($valor)
  {
      $this->fecha = $valor;
  }


  public function GetPrecio()
  {
      return $this->precio;
  }

  public function SetPrecio($valor)
  {
     $this->precio = $valor;
  }


  public function GetIdBicicleta()
  {
      return $this->idBicicleta;
  }

  public function SetIdBicicleta($valor)
  {
      $this->idBicicleta = $valor;
  }

  public static function InsertarLaVentaParametros($venta)
	{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO venta (nombrecliente,fecha,precio,idBicicleta)" . "VALUES('$venta->nombrecliente', '$venta->fecha','$venta->precio','$venta->idBicicleta')");
$consulta->execute();		
return $consulta;
	}


}
?>